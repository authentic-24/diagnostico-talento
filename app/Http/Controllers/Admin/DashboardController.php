<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $subjectsCount = Subject::count();
        $evaluationsCount = \App\Models\Evaluation::count();
        $completedCount = \App\Models\Evaluation::where('status', 'completed')->count();
        $inProgressCount = \App\Models\Evaluation::where('status', 'in_progress')->count();
        $avgScore = \App\Models\Evaluation::where('status', 'completed')->avg('total_score');
        $latestUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $latestSubjects = Subject::orderBy('created_at', 'desc')->take(5)->get();
        $latestEvaluations = \App\Models\Evaluation::with(['evaluator', 'subject'])->orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard', compact(
            'usersCount',
            'subjectsCount',
            'evaluationsCount',
            'completedCount',
            'inProgressCount',
            'avgScore',
            'latestUsers',
            'latestSubjects',
            'latestEvaluations'
        ));
    }
}
