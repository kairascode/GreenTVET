<?php

namespace App\Http\Controllers;
use App\Models\TreeSpecies;

use Illuminate\Http\Request;

class TreeSpeciesController extends Controller
{
    public function index()
    {
        $species = TreeSpecies::all();
        return view('species.index', compact('species'));
    }

    public function create()
    {
        return view('species.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tree_species,name',
            'climatic_conditions' => 'required|string|max:255',
        ]);

        TreeSpecies::create($request->only(['name', 'climatic_conditions']));

        return redirect()->route('species.index')->with('success', 'Tree species created successfully.');
    }

    public function show(TreeSpecies $species)
    {
        return view('species.show', compact('species'));
    }

    public function edit(TreeSpecies $species)
    {
        return view('species.edit', compact('species'));
    }

    public function update(Request $request, TreeSpecies $species)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tree_species,name,' . $species->id,
            'climatic_conditions' => 'required|string|max:255',
        ]);

        $species->update($request->only(['name', 'climatic_conditions']));

        return redirect()->route('species.index')->with('success', 'Tree species updated successfully.');
    }

    public function destroy(TreeSpecies $species)
    {
        $species->delete();
        return redirect()->route('species.index')->with('success', 'Tree species deleted successfully.');
    }
}
