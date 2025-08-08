<?php

namespace App\Http\Controllers;
use App\Models\TreeAllocation;
use App\Models\TreePlanting;
use App\Models\Institution;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'institution_id' => 'nullable|exists:institutions,id',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);

        $institutions = Institution::all();
        $institutionId = $request->input('institution_id');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

      /*  $query = TreePlanting::with(['institution', 'treeSpecies']);
        if ($institutionId) {
            $query->where('institution_id', $institutionId);
        }
        if ($dateFrom && $dateTo) {
            $query->whereBetween('planting_date', [$dateFrom, $dateTo]);
        }

        $plantings = $query->get();
        $allocations = TreeAllocation::when($institutionId, function ($q) use ($institutionId) {
            $q->where('institution_id', $institutionId);
        })->get();

        return view('reports.index', compact('plantings', 'allocations', 'institutions'));*/

        $query = TreePlanting::with(['institution', 'treeSpecies'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude'); // Ensure map data is valid

        if ($institutionId) {
            $query->where('institution_id', $institutionId);
        }

        if ($dateFrom && $dateTo) {
            $query->whereBetween('planting_date', [$dateFrom, $dateTo]);
        }

        // Fetch plantings and ensure relations exist
        $plantings = $query->get()->filter(function ($planting) {
            return $planting->institution && $planting->treeSpecies;
        })->map(function ($planting) {
            return [
                'latitude' => $planting->latitude,
                'longitude' => $planting->longitude,
                'popup' => "<b>Institution:</b> " . e($planting->institution->name) . "<br>" .
                          "<b>Species:</b> " . e($planting->treeSpecies->name) . "<br>" .
                          "<b>Quantity:</b> " . $planting->quantity_planted . "<br>" .
                          "<b>Date:</b> " . $planting->planting_date . "<br>" .
                          "<b>Growth Stage:</b> " . $planting->growth_stage . "<br>" .
                          ($planting->pictorial_evidence ? "<img src=\"" . asset('storage/' . $planting->pictorial_evidence) . "\" width=\"100\">" : "")
            ];
        });

        $allocations = TreeAllocation::with(['institution', 'treeSpecies']) // Eager load relationships
            ->has('institution')                                   // Ensure the relationship exists in DB
            ->has('treeSpecies')                                   // Ensure this one also exists
            ->when($institutionId, function ($q) use ($institutionId) {
             $q->where('institution_id', $institutionId);
        })->get();

        return view('reports.index', compact('plantings', 'allocations', 'institutions'));
    }

}
