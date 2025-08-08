<?php

namespace App\Http\Controllers;
use App\Models\TreePlanting;
use App\Models\Institution;
use App\Models\TreeSpecies;
use Illuminate\Http\Request;

class TreePlantingController extends Controller
{
     public function index()
    {
        $plantings = TreePlanting::with(['institution', 'treeSpecies'])->get();
        return view('plantings.index', compact('plantings'));
    }

    public function create()
    {
        $institutions = Institution::all();
        $species = TreeSpecies::all();
        return view('plantings.create', compact('institutions', 'species'));
    }
     public function show(TreePlanting $planting)
    {
        $planting->load(['institution', 'treeSpecies']);
        return view('plantings.show', compact('planting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'tree_species_id' => 'required|exists:tree_species,id',
            'quantity_planted' => 'required|integer|min:1',
            'planting_date' => 'required|date',
            'pictorial_evidence' => 'nullable|image|max:2048',
             'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $data = $request->all();
        if ($request->hasFile('pictorial_evidence')) {
            $data['pictorial_evidence'] = $request->file('pictorial_evidence')->store('evidence', 'public');
        }

        TreePlanting::create($data);
        return redirect()->route('plantings.index')->with('success', 'Tree planting recorded.');
    }

    public function updateGrowthStage(Request $request, TreePlanting $planting)
    {
        $request->validate([
            'growth_stage' => 'required|in:seedling,sapling,mature,harvested',
        ]);

        $planting->update(['growth_stage' => $request->growth_stage]);
        return redirect()->back()->with('success', 'Growth stage updated.');
    }

    public function map()
    {
        $plantings = TreePlanting::with(['institution', 'treeSpecies'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
        return view('plantings.map', compact('plantings'));
    }
}
