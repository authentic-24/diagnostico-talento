<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluationPdfController extends Controller
{
    public function export($evaluationId)
    {
        $evaluation = \App\Models\Evaluation::with(['subject', 'evaluator', 'responses'])->findOrFail($evaluationId);
        $companyName = $evaluation->evaluator->empresa ?? config('app.name');
        $userName = $evaluation->evaluator->name ?? 'Usuario';
        // $logoPath = public_path('images/logo-app.ico'); // Eliminated variable

        // Obtener el análisis desde EvaluationAnalysis
        $analysisRecord = \App\Models\EvaluationAnalysis::where('evaluation_id', $evaluation->id)->first();
        $analysis = $analysisRecord ? $analysisRecord->analysis : '';
        $diagnosis = '';
        if (is_string($analysis) && str_starts_with(trim($analysis), '{')) {
            $json = json_decode($analysis, true);
            if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                $diagnosis = $json['candidates'][0]['content']['parts'][0]['text'];
            } else {
                $diagnosis = $analysis;
            }
        } else {
            $diagnosis = $analysis;
        }
        $diagnosis = str_replace('*', '', $diagnosis);
        // Eliminar saltos de línea múltiples pero conservar los espacios
        $diagnosis = preg_replace('/\n{2,}/', "\n", $diagnosis);

        // El gráfico debe generarse en frontend y enviarse como base64 si lo necesitas en el PDF
        $chartImage = request()->input('chartImage'); // Opcional: base64 desde el frontend

        $pdf = Pdf::loadView('evaluations.pdf', [
            'evaluation' => $evaluation,
            'companyName' => $companyName,
            'userName' => $userName,
            'diagnosis' => $diagnosis,
            'chartImage' => $chartImage,
            'labels' => json_decode(request()->input('labels', '[]'), true),
            'data' => json_decode(request()->input('data', '[]'), true),
        ]);
        $safeUserName = str_replace([' ', '.', ',', ';', ':', '/', '\\'], '_', $userName);
        return $pdf->download('diagnostico_' . $safeUserName . '.pdf');
    }
}
