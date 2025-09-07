<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EvaluationPrompt;
use App\Models\Evaluation;

class EvaluationPromptSeeder extends Seeder
{
    public function run()
    {
        // Ejemplo: asignar el prompt maestro a la primera evaluación existente
        $evaluation = Evaluation::first();
        if ($evaluation) {
            $prompt = "El Prompt Maestro para Gemini\n" .
                "Valores Organizacionales: [Puntaje]\n" .
                "Principios de Experiencia del Colaborador: [Puntaje]\n" .
                "Fomentar la Libertad y la Colaboración: [Puntaje]\n" .
                "Gestión del Conocimiento: [Puntaje]\n" .
                "Comunicación y Comunidad Interna: [Puntaje]\n" .
                "Tecnología: [Puntaje]\n" .
                "Auto liderazgo: [Puntaje]\n";

            EvaluationPrompt::create([
                'evaluation_id' => $evaluation->id,
                'prompt' => $prompt,
            ]);
        }
    }
}
