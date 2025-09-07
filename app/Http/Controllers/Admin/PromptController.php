<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluationPrompt;
use App\Models\Evaluation;

class PromptController extends Controller
{

    public function index()
    {
        $prompts = EvaluationPrompt::all();
        return view('admin.prompts.index', compact('prompts'));
    }

    public function create()
    {
        return view('admin.prompts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);
        EvaluationPrompt::create([
            'prompt' => $request->prompt,
            'active' => true,
        ]);
        return redirect()->route('admin.prompts.index')->with('success', 'Prompt creado correctamente.');
    }

    public function edit(EvaluationPrompt $prompt)
    {
        return view('admin.prompts.edit', compact('prompt'));
    }

    public function update(Request $request, EvaluationPrompt $prompt)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);
        $prompt->update([
            'prompt' => $request->prompt
        ]);
        return redirect()->route('admin.prompts.index')->with('success', 'Prompt actualizado correctamente.');
    }

    public function deactivate(EvaluationPrompt $prompt)
    {
        $prompt->update(['active' => 0]);
        return redirect()->route('admin.prompts.index')->with('success', 'Prompt desactivado.');
    }

    public function activate(EvaluationPrompt $prompt)
    {
        $prompt->update(['active' => 1]);
        return redirect()->route('admin.prompts.index')->with('success', 'Prompt activado.');
    }
}
