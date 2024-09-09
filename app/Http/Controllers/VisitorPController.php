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
        $details = visitorP::all();
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
            'name' => ['required', 'max:500'],
            'lastName' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'fk_docType_id' => ['required', 'max:100'],
            'docNumber' => ['required','max:500'],
            'phone' => ['required','max:500'],
            'visitDate' => ['required','date_format:d/m/y'], // Accept DD/MM/YY format
            'fk_id_Ubigeo' => ['max:500'],
            'educationalInstitution' => ['required','max:500'],
            'birthDate' => ['nullable','date_format:d/m/Y'],
            'gender' => 'nullable','in:' . implode(',', [visitorP::TYPE1, visitorP::TYPE2, visitorP::TYPE3])
        ]);

        
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
            'fk_id_Ubigeo' => ['required','max:500'],
            'educationalInstitution' => ['required','max:500'],
            'birthDate' => ['nullable','date_format:d/m/Y'],
            'gender' => 'nullable','required|in:' . implode(',', [visitorP::TYPE1, visitorP::TYPE2, visitorP::TYPE3])
       
        ]);

        $visitorP = visitorP::findOrFail($visitorP);
        $visitorP-> name = $request['name'];
        $visitorP->lastName = $request['lastName'];
        $visitorP-> email = $request['email'];
        $visitorP-> fk_docType_id = $request['fk_docType_id'];
        $visitorP-> docNumber = $request['docNumber'];
        $visitorP-> phone = $request['phone'];
        $visitorP-> visitDate = $request['visitDate'];
        $visitorP-> fk_id_Ubigeo = $request['fk_id_Ubigeo'];
        $visitorP-> educationalInstitution = $request['educationalInstitution'];
        $visitorP-> birthDate = $request['birthDate'];
        $visitorP-> gender = $request['gender'];
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
