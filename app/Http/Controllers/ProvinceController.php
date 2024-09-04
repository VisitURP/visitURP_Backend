<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = Province::all();
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
            'id_providence' => 'required',
            'provinceName' => 'required|string|max:255',
        ]);

        $province = Province::create($validatedData);

        return response()->json($province, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        $province = Province::findOrFail($id);
        return response()->json([
            $province
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        $request->validate([
            'provinceName' => 'required|string|max:255',
        ]);

        $prov = Province::findOrFail($prov);
        $prov-> provinceName = $request['provinceName'];
        $prov-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'feedback: ' => $prov
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        $prov = Province::findOrFail($id);
        $prov -> delete();

        return response()->json([
            'Message' => 'Province deleted successfully.'
        ]);
    }
}
