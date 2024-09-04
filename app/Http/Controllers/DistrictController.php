<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = District::all();
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
            'districtName' => 'required|string|max:255',
            'fk_province_id' => 'required|integer',
        ]);

        $district = District::create($validatedData);

        return response()->json($district, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        $district = District::findOrFail($id);
        return response()->json([
            $district
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'districtName' => 'required|string|max:255',
            'fk_province_id' => 'required|integer',
        ]);

        $dist = District::findOrFail($dist);
        $dist-> provinceName = $request['provinceName'];
        $dist-> fk_id_province = $request['fk_province_id'];
        $dist-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'feedback: ' => $dist
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $dist = District::findOrFail($id);
        $dist -> delete();

        return response()->json([
            'Message' => 'District deleted successfully.'
        ]);
    }
}
