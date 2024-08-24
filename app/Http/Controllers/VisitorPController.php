<?php

namespace App\Http\Controllers;

use App\Models\visitorP;
use Illuminate\Http\Request;

class VisitorPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitorP = visitorP::get();

        $data = $visitorP->map(function($visitorP){
            return [
                'id_visitorP' => $visitorP -> id_visitorP,
                'name' => $visitorP -> name,
                'lastName' => $visitorP -> lastName,
                'email' => $visitorP -> email,
                'fk_docType_id' => $visitorP -> fk_docType_id,
                'docNumber' => $visitorP -> docNumber,
                'phone' => $visitorP -> phone,
                'visitDate' => $visitorP -> visitDate,
                'residenceDistrict' => $visitorP -> residentDistrict,
                'educationalInstitution' => $visitorP -> educationalInstitution,
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
            'lastName' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'fk_docType_id' => ['required', 'max:100'],
            'docNumber' => ['required','max:500'],
            'phone' => ['required','max:500'],
            'visitDate' => ['required','date_format:d/m/y'], // Accept DD/MM/YY format
            'residenceDistrict' => ['required','max:500'],
            'educationalInstitution' => ['required','max:500'],
        ]);

        // // PREGUNTAR AL PROFE SI SE HACE UN FILTRO CON EL CORREO Y DOCUMENTO
        // // PARA EVITAR DUPLICADOS
        // // MI DUDA ES QUE SE PUEDE SER VISITOR MUCHAS VECES
        // $visitorEmail = visitorP::where('email', $request->visitorEmail)->first();
        // $visitorDocNumber = visitorP::where('docNumber', $request->visitorDocNumber)->first();
        
        $visitorP = visitorP::create($validatedData);
        
        return response()->json($visitorP, 201);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitorP = visitorP::findOrFail($id);
        return response()->json([
            $visitorP
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitorP $visitorP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $visitorP)
    {
        $request->validate([
            'name' => ['required', 'max:500'],
            'lastName' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'fk_docType_id' => ['required', 'max:100'],
            'docNumber' => ['required','max:500'],
            'phone' => ['required','max:500'],
            'visitDate' => ['required','date_format:d/m/y'], // Accept DD/MM/YY format
            'residenceDistrict' => ['required','max:500'],
            'educationalInstitution' => ['required','max:500'],
        ]);

        $visitorP = visitorP::findOrFail($visitorP);
        $visitorP-> name = $request['name'];
        $visitorP->lastName = $request['lastName'];
        $visitorP-> email = $request['email'];
        $visitorP-> fk_docType_id = $request['fk_docType_id'];
        $visitorP-> docNumber = $request['docNumber'];
        $visitorP-> phone = $request['phone'];
        $visitorP-> visitDate = $request['visitDate'];
        $visitorP-> residentDistrict = $request['residentDistrict'];
        $visitorP-> educationalInstitution = $request['educationalInstitution'];
        $visitorP-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'Physical Visitor: ' => $visitorP
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitorP = visitorP::findOrFail($id);
        $visitorP -> delete();

        return response()->json([
            'Message' => 'Physical visitor deleted successfully.'
        ]);
    }
}
