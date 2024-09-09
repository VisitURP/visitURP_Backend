<?php

namespace App\Http\Controllers;

use App\Models\VisitorV;
use App\Models\VisitV;
use App\Models\Semester;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class VisitorVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = VisitorV::all();
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
            'email' => ['required','email', 'max:500'],
            'lastName' => ['nullable', 'max:500'],
            'fk_docType_id' => ['nullable', 'max:100'],
            'documentNumber' => ['nullable','max:500'],
            'phone' => ['nullable','max:500'],
            'fk_id_Ubigeo' => ['nullable','max:500'],
            'educationalInstitution' => ['nullable','max:500'],
            'birthDate' => ['nullable','datetime'],
            'gender' => 'nullable','required|in:' . implode(',', [VisitorV::TYPE1, VisitorV::TYPE2, VisitorV::TYPE3])
            
        ]);

        $existingVisitor = VisitorV::where('email', $request->input('email'))->first();
        
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
        $visitorV = VisitorV::create($validatedData);
        
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

    public function assignSemester($createdAt)
{
    // Busca el semestre correspondiente basado en la fecha de creación
    $semester = Semester::where('until', '>=', $createdAt)
                        ->orderBy('until', 'asc')
                        ->first();

    // Retorna el id del semestre
    return $semester ? $semester->id_semester : null;
}

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitorV = VisitorV::findOrFail($id);
        return response()->json(
            $visitorV
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
        $validatedData = $request->validate([
            'name' => ['nullable','max:500'],
            'email' => ['nullable','email', 'max:500'],
            'lastName' => ['nullable', 'max:500'],
            'fk_docType_id' => ['nullable', 'max:100'],
            'documentNumber' => ['nullable','max:500'],
            'phone' => ['nullable','max:500'],
            'fk_id_Ubigeo' => ['nullable'],
            'educationalInstitution' => ['nullable','max:500'],
            'birthDate' => ['nullable','datetime'],
            'gender' => 'nullable','required|in:' . implode(',', [VisitorV::TYPE1, VisitorV::TYPE2, VisitorV::TYPE3])
            
        ]);

         // Encuentra el visitante por su ID
    $visitorV = VisitorV::findOrFail($visitorV);

        // filled Solo actualiza los campos si no son null
    if ($request->filled('name')) {
        $visitorV->name = $request->input('name');
    }
    if ($request->filled('email')) {
        $visitorV->email = $request->input('email');
    }
    if ($request->filled('lastName')) {
        $visitorV->lastName = $request->input('lastName');
    }
    if ($request->filled('fk_docType_id')) {
        $visitorV->fk_docType_id = $request->input('fk_docType_id');
    }
    if ($request->filled('documentNumber')) {
        $visitorV->documentNumber = $request->input('documentNumber');
    }
    if ($request->filled('phone')) {
        $visitorV->phone = $request->input('phone');
    }
    if ($request->filled('fk_id_Ubigeo')) {
        $visitorV->fk_id_Ubigeo = $request->input('fk_id_Ubigeo');
    }
    if ($request->filled('educationalInstitution')) {
        $visitorV->educationalInstitution = $request->input('educationalInstitution');
    }
    if ($request->filled('birthDate')) {
        $visitorV->birthDate = $request->input('birthDate');
    }
    if ($request->filled('gender')) {
        $visitorV->gender = $request->input('gender');
    }

    // Guarda los cambios
    $visitorV->save();

    return response()->json([
        'Message' => 'Data already updated.',
        'Virtual visitor' => $visitorV
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $VisitorV = VisitorV::findOrFail($id);
        $VisitorV -> delete();

        return response()->json([
            'Message' => 'VisitorV deleted successfully.'
        ]);
    }
}
