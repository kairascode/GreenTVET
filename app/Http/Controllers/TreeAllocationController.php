<?php

namespace App\Http\Controllers;
use App\Models\TreeAllocation;
use App\Models\Institution;
use App\Models\TreeSpecies;

use Illuminate\Http\Request;

class TreeAllocationController extends Controller
{
   public function index()
    {
        $allocations = TreeAllocation::with(['institution', 'treeSpecies'])->get();
        return view('allocations.index', compact('allocations'));
    }

    public function create()
    {
        $institutions = Institution::all();
        $species = TreeSpecies::all();
        return view('allocations.create', compact('institutions', 'species'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'tree_species_id' => 'required|exists:tree_species,id',
            'quantity_allocated' => 'required|integer|min:1',
        ]);

        TreeAllocation::create($request->all());
        return redirect()->route('allocations.index')->with('success', 'Tree allocation created successfully.');
    }

    public function edit(TreeAllocation $allocation)
    {
        $institutions = Institution::all();
        $species = TreeSpecies::all();
        return view('allocations.edit', compact('allocation', 'institutions', 'species'));
    }

    public function update(Request $request, TreeAllocation $allocation)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'tree_species_id' => 'required|exists:tree_species,id',
            'quantity_allocated' => 'required|integer|min:1',
        ]);

        $allocation->update($request->all());
        return redirect()->route('allocations.index')->with('success', 'Tree allocation updated successfully.');
    }

    public function destroy(TreeAllocation $allocation)
    {
        $allocation->delete();
        return redirect()->route('allocations.index')->with('success', 'Tree allocation deleted successfully.');
    }
}
