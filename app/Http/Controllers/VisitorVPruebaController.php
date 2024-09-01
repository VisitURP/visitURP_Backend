<?php

namespace App\Http\Controllers;

use App\Models\visitorV_prueba;
use App\Models\VisitV;
use App\Models\Semester;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class VisitorVPruebaController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Visitor = visitorV_prueba::all();
        return response()->json($Visitor);
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
            'documentNumber' => ['nullable','max:500'], //'exists:doc_types,id_docType'
            'phone' => ['nullable','max:500'],
            'fk_id_Province'=>['nullable', 'max:100'], //'exists:doc_types,id_Providence'
            'fk_id_District'=>['nullable', 'max:100'], //'exists:doc_types,id_District'
            'educationalInstitution' => ['nullable','max:500'],
        ]);

        $existingVisitor = visitorV_prueba::where('email', $request->input('email'))->first();
        
        if ($existingVisitor) {
            $visitV = VisitV::create([
               'fk_id_visitorV' => $existingVisitor->id_visitorV,
               'fk_id_semester' => $this->assignSemester($existingVisitor->created_at),
            ]);
        // Retorna los datos del visitante existente para que Unity los muestre en el modal
        return response()->json([
            'isNewVisitor' => false,
            'visitorV' => $existingVisitor,
            'visitV' => $visitV,
        ]);
    }

    else{
        $visitorV = visitorV_prueba::create($validatedData);
        
        $visitV = VisitV::create([
            'fk_id_visitorV' => $visitorV->id_visitorV,
            'fk_id_semester' => $this->assignSemester($visitorV->created_at),
        ]);

    // Retornar la respuesta con los datos del visitante y de la visita
    return response()->json([
        'isNewVisitor' => true,
        'visitorV' => $visitorV,
        'visitV' => $visitV,
    ], 201);

       }
    }

        

    public static function assignSemester($createdAt)
    {
        $createdAt = new Carbon($createdAt);
        $semester = Semester::where('until', '>', $createdAt)->orderBy('until')->first();
        
        return $semester ? $semester->id_semester : null;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitorV = visitorV_prueba::findOrFail($id);
        return response()->json(
            $visitorV
        
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(visitorV_prueba $visitorV)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, int $visitorV)
     {
         $request->validate([
             'name' => ['sometimes', 'max:500'],
             'email' => ['sometimes','email', 'max:500'],
             'lastName' => ['nullable', 'max:500'],
             'fk_docType_id' => ['nullable', 'max:100'],
             'documentNumber' => ['nullable','max:500'],
             'phone' => ['nullable','max:500'],
             'fk_id_Province'=>['nullable', 'max:100'],//'exists:doc_types,id_Providence'
             'fk_id_District'=>['nullable', 'max:100'], //'exists:doc_types,id_District'
             'educationalInstitution' => ['nullable','max:500'],
         ]);
     
         $visitorV = visitorV_prueba::findOrFail($visitorV);
     
         if ($request->has('name')) {
             $visitorV->name = $request->input('name');
         }
         if ($request->has('email')) {
             $visitorV->email = $request->input('email');
         }
         if ($request->has('lastName')) {
             $visitorV->lastName = $request->input('lastName');
         }
         if ($request->has('fk_docType_id')) {
             $visitorV->fk_docType_id = $request->input('fk_docType_id');
         }
         if ($request->has('documentNumber')) {
             $visitorV->documentNumber = $request->input('documentNumber');
         }
         if ($request->has('phone')) {
             $visitorV->phone = $request->input('phone');
         }
         /*
         if ($request->has('fk_id_Province')) {
            $visitorV->fk_id_Province = $request->input('fk_id_Province');
        }
        if ($request->has('fk_id_District')) {
            $visitorV->fk_id_District = $request->input('fk_id_District');
        }
            */
         if ($request->has('educationalInstitution')) {
             $visitorV->educationalInstitution = $request->input('educationalInstitution');
         }
     
         $visitorV->save();

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
        $visitorV = visitorV_prueba::findOrFail($id);
        $visitorV -> delete();

        return response()->json([
            'Message' => 'Virtual visitor deleted successfully.'
        ]);
    }
}
