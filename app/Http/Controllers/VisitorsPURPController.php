<?php

namespace App\Http\Controllers;

use App\Models\visitorsP_URP;
use Illuminate\Http\Request;

class VisitorsPURPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details=visitorsP_URP::all();
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
    try {
        $validatedData = $request->validate([
            'fk_docType_id' => ['required', 'max:100'],
            'name' => ['required', 'max:500'],
            'lastName' => ['required', 'max:500'],
            'email' => ['required', 'email', 'max:500'],
            'docNumber' => ['required', 'max:500'],
            'visitDateP' => ['required', 'date_format:d/m/y'], 
            'fk_id_Province' => ['nullable', 'integer'],
            'fk_id_District' => ['nullable', 'integer'],
            'educationalInstitution' => ['required', 'max:500'],
        ]);

        // Intentar convertir la fecha al formato correcto
        $validatedData['visitDateP'] = \Carbon\Carbon::createFromFormat('d/m/y', trim($validatedData['visitDateP']))->format('Y-m-d');

        $visitorP_URP = visitorsP_URP::create($validatedData);
        return response()->json($visitorP_URP, 201);

    } catch (\Exception $e) {
        \Log::error('Error en el método store de VisitorPURPController: '.$e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {   
      try {
        $visitorP_URP = visitorsP_URP::findOrFail($id);
        return response()->json($visitorP_URP);
       } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
        }
   }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitorsP_URP $visitorP_URP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $visitorP_URP)
    {
        try{

            $request ->validate([
                'fk_docType_id' => ['required', 'max:100'],
            'name' => ['required', 'max:500'],
            'lastName' => ['required', 'max:500'],
            'email' => ['required','email', 'max:500'],
            'docNumber' => ['required','max:500'],
            'visitDateP' => ['required','date_format:d/m/y'], 
            'fk_id_Province' => ['nullable','integer'],
            'fk_id_District' => ['nullable','integer'],
            'educationalInstitution' => ['required','max:500'],
        ]);
        
        $visitorP_URP = visitorsP_URP::findOrFail($visitorP_URP);
        $visitorP_URP-> fk_docType_id = $request['fk_docType_id'];
        $visitorP_URP-> name = $request['name'];
        $visitorP_URP-> lastName = $request['lastName'];
        $visitorP_URP-> email = $request['email'];
        $visitorP_URP-> docNumber = $request['docNumber'];
        $visitorP_URP-> visitDateP = $request['visitDateP'];
        $visitorP_URP-> fk_id_Province = $request['fk_id_Province'];
        $visitorP_URP-> fk_id_District = $request['fk_id_District'];
        $visitorP_URP-> educationalInstitution = $request['educationalInstitution'];
        $visitorP_URP-> save();
        
        return response()->json([
            'Message' => 'Data already updated.',
            'Physical Visitor: ' => $visitorP_URP
        ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitorP_URP=visitorsP_URP::findOrFail($id);
        $visitorP_URP->delete();
        return response()->json(['Message'=>'Visitor preference deleted successfully.']);
    }
}

