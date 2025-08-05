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
        $institutions = Institution::all();
        $institutionId = $request->input('institution_id');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $query = TreePlanting::with(['institution', 'treeSpecies']);
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

        return view('reports.index', compact('plantings', 'allocations', 'institutions'));
    }
}
