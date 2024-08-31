<?php

namespace App\Http\Controllers;

use App\Models\Ubigeo;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function filterByDistrict($districtCode)
    {
        $results = Ubigeo::where('cod_Ubigeo', 'LIKE', $districtCode . '%')->get();
        return response()->json($results);
    }

    public function filterByProvince($provinceCode)
    {
        $results = Ubigeo::where('cod_Ubigeo', 'LIKE', $provinceCode . '%')->get();
        return response()->json($results);
    }

    public function filterByDepartment($departmentCode)
    {
        $results = Ubigeo::where('cod_Ubigeo', 'LIKE', $departmentCode . '%')->get();
        return response()->json($results);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ubigeo $ubigeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ubigeo $ubigeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ubigeo $ubigeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ubigeo $ubigeo)
    {
        //
    }
}
