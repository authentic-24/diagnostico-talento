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
        // Usar siempre el texto fijo proporcionado por el usuario
        $analysis = "Apreciaciones de tu diagnóstico\n\nRRHH como Arquitectos del Cerebro Organizacional, comprender y optimizar los sistemas biológicos que impulsan la motivación, la creatividad y el bienestar. \n\n1. De la Cultura al Cableado Neural\nNo basta con definir valores; hay que vivirlos para generar coherencia y confianza. Cada acción de la empresa debe ser una señal para el cerebro de sus colaboradores. Un entorno de trabajo coherente con los valores que promueve activa la liberación de dopamina y oxitocina, creando lealtad y seguridad psicológica.\n \n2. De los Procesos a la Eficiencia Cerebral\nLa sobrecarga de información y los procesos complejos agotan los recursos mentales. La clave es liberar al cerebro de tareas tediosas para que pueda concentrarse en lo que realmente importa.\n\n3. Del Liderazgo Tradicional al empoderar a cada individuo para que gestione su propio bienestar. Entender la neuroplasticidad nos permite desarrollar la capacidad de adaptarnos y crecer.\n\n4. Del Bienestar al Hardware Biológico\nLa salud mental no es un lujo; es la base para el rendimiento. Las empresas deben proteger el eje HPA, el sistema biológico de respuesta al estrés.\n \nAl adoptar esta visión, RRHH se convierte en un socio estratégico que entiende y optimiza la maquinaria más poderosa de la organización: el cerebro humano. Esto no es una tendencia, es el futuro de la gestión de talento.";
        // Guardar el análisis en la base de datos si no existe
        if (!$analysisRecord) {
            \App\Models\EvaluationAnalysis::updateOrCreate(
                ['evaluation_id' => $evaluation->id],
                ['prompt' => $prompt, 'analysis' => $analysis]
            );
        }
        /*
        // --- API Gemini (comentado por solicitud del usuario) ---
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
        // --- Fin API Gemini ---
        */

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

        // Calcular el puntaje como porcentaje
        $responses = \App\Models\Response::where('evaluation_id', $evaluation->id)->get();
        $totalQuestions = $responses->count();
        $sumScore = $responses->sum('value');
        $maxScore = $totalQuestions * 4;
        $percentScore = $maxScore > 0 ? round(($sumScore / $maxScore) * 100, 1) : 0;

        $evaluation->status = 'completed';
        $evaluation->total_score = $percentScore;
        $evaluation->completed_at = now();
        $evaluation->save();

        return redirect()->route('evaluations.index')->with('success', 'Evaluación enviada con éxito.');
    }
}
