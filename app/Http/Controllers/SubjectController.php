<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\EvaluationPrompt;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $items = \App\Models\Item::whereNull('subject_id')->get();
        $prompts = \App\Models\EvaluationPrompt::where('active', 1)->get();
        return view('admin.subjects.create', compact('items', 'prompts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'evaluation_prompt_id' => 'required|exists:evaluation_prompts,id',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'evaluation_prompt_id' => $request->evaluation_prompt_id,
        ]);

        // Asociar items seleccionados
        if ($request->has('items')) {
            \App\Models\Item::whereIn('id', $request->items)->update(['subject_id' => $subject->id]);
        }

        return redirect()->route('admin.subjects.index')->with('success', 'Tema creado correctamente y prompt asociado.');
    }

    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'evaluation_prompt_id' => 'required|exists:evaluation_prompts,id',
        ]);

        $subject->update([
            'name' => $request->name,
            'evaluation_prompt_id' => $request->evaluation_prompt_id,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Tema actualizado correctamente y prompt actualizado.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Tema eliminado correctamente.');
    }
}
