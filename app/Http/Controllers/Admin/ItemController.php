<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {

        $items = Item::all();
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $subjects = \App\Models\Subject::all();
        return view('admin.items.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        Item::create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Ítem creado correctamente.');
    }

    public function show(Item $item)
    {
        return view('admin.items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $subjects = \App\Models\Subject::all();
        return view('admin.items.edit', compact('item', 'subjects'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',

        ]);

        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,

        ]);

        return redirect()->route('admin.items.index')->with('success', 'Ítem actualizado correctamente.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Ítem eliminado correctamente.');
    }
}
