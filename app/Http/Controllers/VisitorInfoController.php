<?php

namespace App\Http\Controllers;

use App\Models\VisitorInfo;
use Illuminate\Http\Request;

class VisitorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitorInfo = VisitorInfo::all();
        return response()->json($visitorInfo);
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
        $request->validate([
            'fk_id_visitor' => 'required|string',
            'visitor_type' => 'required',
            'typeOfVisitor' => 'required|string',
        ]);

        $visitorInfo = VisitorInfo::create($request->all());

        return response()->json($visitorInfo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitorInfo = VisitorInfo::find($id);

        if (!$visitorInfo) {
            return response()->json(['message' => 'visitorInfo not found'], 404);
        }

        return response()->json($visitorInfo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorInfo $visitorInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisitorInfo $visitorInfo)
    {
        $visitorInfo = VisitorInfo::find($id);

        if (!$visitorInfo) {
            return response()->json(['message' => 'VisitorInfo not found'], 404);
        }

        $request->validate([
            'fk_id_visitor' => 'required|string',
            'visitor_type' => 'required',
            'typeOfVisitor' => 'required|string',
        ]);

        $visitorInfo->update($request->all());

        return response()->json($visitorInfo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitorInfo = VisitorInfo::find($id);

        if (!$visitorInfo) {
            return response()->json(['message' => 'VisitorInfo not found'], 404);
        }

        $visitorInfo->delete();

        return response()->json(['message' => 'VisitorInfo deleted successfully']);
    }
}
