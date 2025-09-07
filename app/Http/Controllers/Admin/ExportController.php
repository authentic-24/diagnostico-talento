<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EvaluationsExport;

class ExportController extends Controller
{
    public function evaluations()
    {
        return Excel::download(new EvaluationsExport, 'evaluaciones.xlsx');
    }
}
