<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\EvaluationAnalysis;
use App\Models\EvaluationPrompt;

class EvaluationController extends Controller
{
    public function results(Evaluation $evaluation)
    {
        $items = $evaluation->subject ? $evaluation->subject->items : collect();
        $labels = [];
        $data = [];
        foreach ($items as $item) {
            $labels[] = $item->title;
            $responses = \App\Models\Response::where('evaluation_id', $evaluation->id)
                ->whereIn('question_id', $item->questions->pluck('id'))
                ->pluck('value');
            $avg = $responses->count() ? round($responses->avg(), 2) : 0;
            $data[] = $avg;
        }

        // Recuperar el prompt maestro administrable asociado al subject
        $promptTemplate = $evaluation->subject && $evaluation->subject->prompt ? $evaluation->subject->prompt->prompt : '';
        // Reemplazar los placeholders por los puntajes
        // Calcular porcentajes para cada dimensión
        $porcentaje = function ($valor) {
            return is_numeric($valor) ? round(($valor / 4) * 100) . '%' : '-';
        };
        $placeholders = [
            '[VALORES]' => $data[0] ?? '-',
            '[EXPERIENCIA]' => $data[1] ?? '-',
            '[COLABORACION]' => $data[2] ?? '-',
            '[CONOCIMIENTO]' => $data[3] ?? '-',
            '[DESARROLLO]' => $data[4] ?? '-',
            '[TECNOLOGIA]' => $data[5] ?? '-',
            '[LIDERAZGO]' => $data[6] ?? '-',
            '[BENEFICIOS]' => $data[7] ?? '-',
            '[SALUD_MENTAL]' => $data[8] ?? '-',
            '[SALUD_FISICA]' => $data[9] ?? '-',
            '%DESARROLLO%' => isset($data[4]) ? $porcentaje($data[4]) : '-',
            '%BENEFICIOS%' => isset($data[7]) ? $porcentaje($data[7]) : '-',
            '%SALUD_MENTAL%' => isset($data[8]) ? $porcentaje($data[8]) : '-',
            '%SALUD_FISICA%' => isset($data[9]) ? $porcentaje($data[9]) : '-',
        ];
        $prompt = str_replace(array_keys($placeholders), array_values($placeholders), $promptTemplate);

        // Buscar si ya existe el análisis guardado
        $analysisRecord = \App\Models\EvaluationAnalysis::where('evaluation_id', $evaluation->id)->first();
        if ($analysisRecord && $analysisRecord->analysis) {
            $analysis = $analysisRecord->analysis;
        } else {
            // Llamada a la API Gemini solo si no existe
            $analysis = null;
            $model = 'gemini-1.5-flash'; // Cambia por el modelo que uses
            $token = env('GEMINI_API_KEY', 'AIzaSyDXcJ1nZoEe2Ilkt_RAPAcgausCQjjS0To'); // Usa tu clave real
            try {
                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1beta/models/$model:generateContent?key=$token", [
                    'contents' => [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]);
                if ($response->successful()) {
                    $analysis = $response->json('result') ?? $response->body();
                } else {
                    $analysis = 'No se pudo obtener la recomendación. Verifica la API.';
                }
            } catch (\Exception $e) {
                $analysis = 'Error al conectar con Gemini: ' . $e->getMessage();
            }
            // Guardar el análisis en la base de datos
            \App\Models\EvaluationAnalysis::updateOrCreate(
                ['evaluation_id' => $evaluation->id],
                ['prompt' => $prompt, 'analysis' => $analysis]
            );
        }

        return view('evaluations.results', compact('evaluation', 'labels', 'data', 'analysis'));
    }
    public function index()
    {
        $evaluations = Evaluation::where('evaluator_id', Auth::id())->get();
        return view('evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        // Obtener los subjects para los que el usuario NO tiene evaluación en progreso o completada
        $evaluatedSubjectIds = Evaluation::where('evaluator_id', Auth::id())
            ->whereIn('status', ['in_progress', 'completed'])
            ->pluck('subject_id');
        $subjects = Subject::whereNotIn('id', $evaluatedSubjectIds)->get();

        return view('evaluations.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        // Verificar si ya existe una evaluación para este usuario y subject
        $exists = Evaluation::where('evaluator_id', Auth::id())
            ->where('subject_id', $request->subject_id)
            ->whereIn('status', ['in_progress', 'completed'])
            ->exists();
        if ($exists) {
            return redirect()->route('evaluations.index')->with('error', 'Ya has iniciado o completado esta evaluación.');
        }

        $evaluation = Evaluation::create([
            'evaluator_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'status' => 'in_progress',
            'total_score' => 0,
            'started_at' => now(),
            'completed_at' => null,
        ]);

        return redirect()->route('evaluations.show', $evaluation);
    }

    public function show(Evaluation $evaluation)
    {
        $items = $evaluation->subject ? $evaluation->subject->items : collect();
        $questions = collect();
        foreach ($items as $item) {
            foreach ($item->questions as $question) {
                $questions->push($question);
            }
        }

        return view('evaluations.show', compact('evaluation', 'questions'));
    }

    public function submit(Request $request, Evaluation $evaluation)
    {
        // Opciones y su valor numérico
        $optionValues = [
            'Constantemente' => 4,
            'Frecuentemente' => 3,
            'Ocasionalmente' => 2,
            'Casi nunca' => 1
        ];

        foreach ($request->responses as $questionId => $response) {
            $value = isset($optionValues[$response]) ? $optionValues[$response] : null;
            \App\Models\Response::create([
                'evaluation_id' => $evaluation->id,
                'question_id' => $questionId,
                'value' => $value,
                'comment' => null
            ]);
        }

        // Calcular el porcentaje ponderado considerando todas las preguntas de los ítems
        $items = $evaluation->subject ? $evaluation->subject->items : collect();
        $totalQuestions = 0;
        foreach ($items as $item) {
            $totalQuestions += $item->questions->count();
        }
        $responses = \App\Models\Response::where('evaluation_id', $evaluation->id)->get();
        $maxScore = $totalQuestions * 4;
        $sumScore = $responses->sum('value');
        $porcentajePonderado = $maxScore > 0 ? round(($sumScore / $maxScore) * 100, 2) : 0;
        $evaluation->status = 'completed';
        $evaluation->total_score = $porcentajePonderado;
        $evaluation->completed_at = now();
        $evaluation->save();

        return redirect()->route('evaluations.index')->with('success', 'Evaluación enviada con éxito.');
    }
}
