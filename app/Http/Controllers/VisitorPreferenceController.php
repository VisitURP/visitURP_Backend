<?php

namespace App\Http\Controllers;

use App\Models\VisitorPreference;
use Illuminate\Http\Request;

class VisitorPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = VisitorPreference::all();
        return response()->json($details);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'visitor_type' => 'required|string|in:V,P', // Validación del campo discriminador
            'fk_id_visitorV' => 'nullable|integer|required_if:visitor_type,V',
            'fk_id_visitorP' => 'nullable|integer|required_if:visitor_type,P',
            'fk_id_academicInterested' => 'required|integer',
        ]);
    
        $visitorPreference = VisitorPreference::create($validatedData);
    
        return response()->json($visitorPreference, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitorPreference = VisitorPreference::findOrFail($id);
        return response()->json([
            $visitorPreference
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorPreference $visitorPreference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $visitorPreference)
    {
        $request->validate([
            'visitor_type' => ['required', 'string','in:V,P'],
            'fk_id_visitorV' => ['nullable', 'integer','required_if:visitor_type,V'],
            'fk_id_visitorP' => ['nullable', 'integer','required_if:visitor_type,P'],
            'fk_id_academicInterested' => ['required','integer'],
        ]);

        $visitorPreference = VisitorPreference::findOrFail($visitorPreference);
        $visitorPreference-> visitor_type = $request['visitor_type'];
        $visitorPreference->fk_id_visitorV = $request['fk_id_visitorV'];
        $visitorPreference->fk_id_visitorP = $request['fk_id_visitorP'];
        $visitorPreference->fk_id_academicInterested = $request['fk_id_academicInterested'];
        $visitorPreference-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'Visitor Preference: ' => $visitorPreference
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitorPreference = VisitorPreference::findOrFail($id);
        $visitorPreference -> delete();

        return response()->json([
            'Message' => 'Visitor preference deleted successfully.'
        ]);
    }
}
