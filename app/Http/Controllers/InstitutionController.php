<?php

namespace App\Http\Controllers;
use App\Models\Institution;
use Illuminate\Http\Request;


class InstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::all();
        return view('institutions.index', compact('institutions'));
    }

    public function create()
    {
        return view('institutions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'contact_email' => 'nullable|email',
        ]);

        Institution::create($request->all());
        return redirect()->route('institutions.index')->with('success', 'Institution added.');
    }
}
