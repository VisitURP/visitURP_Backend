<?php

namespace App\Http\Controllers;


use App\Models\VisitorV;
use Illuminate\Http\Request;

class VisitorVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitorsV = VisitorV::all();
        return response()->json($visitorsV);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $visitorV = VisitorV::create($request->all());
        return response()->json($visitorV, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitorV = VisitorV::findOrFail($id);
        return response()->json($visitorV);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $visitorV = VisitorV::findOrFail($id);
        $visitorV->update($request->all());
        return response()->json($visitorV); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitor = VisitorV::findOrFail($id);
        $visitor->delete();
        return response()->json(null, 204);
    }
}
