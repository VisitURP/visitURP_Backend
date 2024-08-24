<?php

namespace App\Http\Controllers;

use App\Models\VisitorInfoXapplicant;
use Illuminate\Http\Request;

class VisitorInfoXapplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vXa = VisitorInfoXapplicant::all();
        return response()->json($vXa);
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
            'fk_applicant_id' => 'required|exists:applicants,id_applicant',
            'fk_visitorInfo_id' => 'required|exists:visitor_infos,id_visitorInfo',
            'fk_docType_id' => 'nullable|exists:doc_types,id_docType',
            'documentNumber' => 'required|string',
            'name' => 'required|string',
            'lastName' => 'required|string',
            'email' => ['required','email', 'max:500'],
            'phone' => 'max:500',
            'educationalInstitution' => 'max:500',
            'residenceDistrict' => 'max:500',
            'studentCode' => 'required|string',
            'admitted' => 'required|boolean',
        ]);

        $Vapplicant = VisitorInfoXapplicant::create($request->all());

        return response()->json($Vapplicant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $vXa = VisitorInfoXapplicant::find($id);

        if (!$vXa) {
            return response()->json(['message' => 'Applicant not found'], 404);
        }

        return response()->json($vXa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorInfoXapplicant $visitorInfoXapplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $Vapplicant = VisitorInfoXapplicant::find($id);

        if (!$Vapplicant) {
            return response()->json(['message' => 'Visitor info x Applicant not found'], 404);
        }

        $request->validate([
            'fk_applicant_id' => 'required|exists:applicants,id_applicant',
            'fk_visitorInfo_id' => 'required|exists:visitor_infos,id_visitorInfo',
            'fk_docType_id' => 'nullable|exists:doc_types,id_docType',
            'documentNumber' => 'required|string',
            'name' => 'required|string',
            'lastName' => 'required|string',
            'email' => ['required','email', 'max:500'],
            'phone' => 'max:500',
            'educationalInstitution' => 'max:500',
            'residenceDistrict' => 'max:500',
            'studentCode' => 'required|string',
            'admitted' => 'required|boolean',
        ]);

        $Vapplicant->update($request->all());

        return response()->json($Vapplicant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $Vapplicant = VisitorInfoXapplicant::find($id);

        if (!$Vapplicant) {
            return response()->json(['message' => 'Visitor X Applicant not found'], 404);
        }

        $Vapplicant->delete();

        return response()->json(['message' => 'Visitor X Applicant deleted successfully']);
    }
}
