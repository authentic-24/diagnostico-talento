<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;

// Ruta de políticas
Route::get('/politicas', function () {
    return view('politicas');
})->name('politicas');

Route::get('/', function () {
    return redirect()->route('login');
});

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user instanceof \App\Models\User && method_exists($user, 'hasRole') && $user->hasRole('admin')) {
        return app(DashboardController::class)->index();
    }
    $evaluations = \App\Models\Evaluation::where('evaluator_id', Auth::id())->get();
    return view('dashboard', compact('evaluations'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('evaluations', EvaluationController::class)->only(['index', 'show', 'create', 'store']);
    Route::post('evaluations/{evaluation}/submit', [EvaluationController::class, 'submit'])->name('evaluations.submit');
    Route::get('evaluations/{evaluation}/results', [EvaluationController::class, 'results'])->name('evaluations.results');

    Route::match(['get', 'post'], 'evaluations/{evaluation}/export-pdf', [\App\Http\Controllers\EvaluationPdfController::class, 'export'])->name('evaluations.exportPdf');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::resource('items', AdminItemController::class);
    Route::resource('questions', AdminQuestionController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'store', 'show']);
    Route::get('export/evaluations', [\App\Http\Controllers\Admin\ExportController::class, 'evaluations'])->name('export.evaluations');
    Route::resource('prompts', App\Http\Controllers\Admin\PromptController::class);
    Route::post('prompts/{prompt}/deactivate', [App\Http\Controllers\Admin\PromptController::class, 'deactivate'])->name('prompts.deactivate');
    Route::post('prompts/{prompt}/activate', [App\Http\Controllers\Admin\PromptController::class, 'activate'])->name('prompts.activate');
});

require __DIR__ . '/auth.php';
