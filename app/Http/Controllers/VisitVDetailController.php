<?php

namespace App\Http\Controllers;

use App\Models\VisitVDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class VisitVDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = VisitVDetail::all();
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
        $validated = $request->validate([
            'id_visitorV' => 'required|exists:visitor_v_s,id_visitorV',
            'id_visitV' => 'required|exists:visit_v_s,id_visitV',
            'fk_id_builtArea' => 'required|exists:built_areas,id_builtArea',
            'kindOfEvent' => 'required|string',
            'get' => 'required|string',
            'DateTime' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $detail = VisitVDetail::create($validated);

        return response()->json($detail, 201);
    }

    

    /**
     * Display the specified resource.
     */
    public function show($id_visitor, $id_visit)
    {
        $detail = VisitVDetail::findComposite($id_visitor, $id_visit);
        
        if (!$detail) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json($detail);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitVDetail $visitVDetail)
    {
        //
    }

    public function update(Request $request, $id_visitor, $id_visit)
    {
        $detail = VisitVDetail::findComposite($id_visitor, $id_visit);
        
        if (!$detail) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $validated = $request->validate([
            'fk_id_builtArea' => 'required|exists:built_areas,id_builtArea',
            'kindOfEvent' => 'required|string',
            'get' => 'required|string',
            'DateTime' => 'required|date',
        ]);

        $detail->update($validated);

        return response()->json($detail);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_visitor, $id_visit)
    {
        $deleted = VisitVDetail::deleteComposite($id_visitor, $id_visit);
        
        if (!$deleted) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        return response()->json(['message' => 'Record deleted']);
    }
}
