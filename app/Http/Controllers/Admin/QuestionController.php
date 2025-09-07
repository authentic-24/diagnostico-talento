<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Item;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('item')->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        // Solo ítems que no están asignados a ningún subject
        $items = Item::whereNull('subject_id')->get();
        return view('admin.questions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'text' => 'required|string|max:500',
        ]);

        Question::create($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Pregunta creada correctamente.');
    }

    public function edit(Question $question)
    {
        $items = Item::all();
        return view('admin.questions.edit', compact('question', 'items'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'text' => 'required|string|max:500',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Pregunta actualizada correctamente.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Pregunta eliminada correctamente.');
    }
}
