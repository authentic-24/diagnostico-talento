<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('prompts', App\Http\Controllers\Admin\PromptController::class);
    Route::post('prompts/{prompt}/deactivate', [App\Http\Controllers\Admin\PromptController::class, 'deactivate'])->name('admin.prompts.deactivate');
});
