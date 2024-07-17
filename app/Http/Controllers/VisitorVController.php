<?php

namespace App\Http\Controllers;

use App\Models\VisitorV;
use App\Models\VisitV;
use Illuminate\Http\Request;

class VisitorVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitorV = VisitorV::get();

        $data = $visitorV->map(function($visitorV){
            return [
                'id_visitorV' => $visitorV -> id_visitorV,
                'name' => $visitorV -> name,
                'email' => $visitorV -> email,
                'lastName' => $visitorV -> lastName,
                'fk_docType_id' => $visitorV -> fk_docType_id,
                'documentNumber' => $visitorV -> documentNumber,
                'phone' => $visitorV -> phone,
            ];
        });

        //pequeña modificacion
        return response()->json(
            $data
        );
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
            'name' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'lastName' => ['nullable', 'max:500'],
            'fk_docType_id' => ['nullable', 'max:100'],
            'documentNumber' => ['nullable','max:500'],
            'phone' => ['nullable','max:500'],
        ]);

        $visitorV = VisitorV::create($validatedData);
        
        // Crear la visita asociada al visitante recién creado
    $visitV = visitV::create([
        'fk_id_visitorV' => $visitorV->id_visitorV,
    ]);

    // Retornar la respuesta con los datos del visitante y de la visita
    return response()->json([
        'visitorV' => $visitorV,
        'visitV' => $visitV,
    ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitorV = VisitorV::findOrFail($id);
        return response()->json([
            $visitorV
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorV $visitorV)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $visitorV)
    {
        $request->validate([
            'name' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'lastName' => ['nullable', 'max:500'],
            'fk_docType_id' => ['nullable', 'max:100'],
            'documentNumber' => ['nullable','max:500'],
            'phone' => ['nullable','max:500'],
        ]);

        $visitorV = VisitorV::findOrFail($visitorV);
        $visitorV-> name = $request['name'];
        $visitorV-> email = $request['email'];
        $visitorV->lastName = $request['lastName'];
        $visitorV-> fk_docType_id = $request['fk_docType_id'];
        $visitorV-> documentNumber = $request['documentNumber'];
        $visitorV-> phone = $request['phone'];
        $visitorV-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'Virtual visitor: ' => $visitorV
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitorV = VisitorV::findOrFail($id);
        $visitorV -> delete();

        return response()->json([
            'Message' => 'Virtual visitor deleted successfully.'
        ]);
    }
}
