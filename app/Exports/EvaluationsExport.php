<?php

namespace App\Exports;

use App\Models\Evaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EvaluationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Evaluation::with(['evaluator', 'subject'])
            ->get()
            ->map(function ($evaluation) {
                return [
                    'ID' => $evaluation->id,
                    'Usuario' => $evaluation->evaluator->name ?? '',
                    'Subject' => $evaluation->subject->name ?? '',
                    'Estado' => $evaluation->status,
                    'Puntaje' => $evaluation->total_score,
                    'Fecha' => $evaluation->created_at->format('d/m/Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Subject',
            'Estado',
            'Puntaje',
            'Fecha'
        ];
    }
}
