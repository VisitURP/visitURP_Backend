<?php

namespace App\Http\Controllers;

use App\Models\VisitorInfoXApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\JsonResponse;

class VisitorInfoXApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function syncVisitorInfoXApplicant(): JsonResponse
    {
        // Llamada al comando usando Artisan
        Artisan::call('sync:visitor-infoXapplicant');

        // Opcional: Capturar el resultado del comando y mostrar en la respuesta
        $output = Artisan::output();

        return response()->json([
            'success' => true,
            'message' => 'Sincronización de VisitorInfoXApplicant ejecutada.',
            'output' => $output, // Muestra la salida del comando (opcional)
        ]);
    }

    public function index()
    {
        $records = VisitorInfoxApplicant::all();
        return response()->json($records);
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
        // Validar el request
        $request->validate([
            'fk_id_applicant' => 'nullable',
            'fk_id_visitor' => 'nullable',
            'visitor_type' => 'nullable|in:V,P,B',
            'admitted' => 'boolean',
        ]);

        // Verificar si el registro ya existe basado en fk_id_applicant y fk_id_visitor
        $existingRecord = VisitorInfoxApplicant::where('fk_id_applicant', $request->fk_id_applicant)
                            ->where('fk_id_visitor', $request->fk_id_visitor)
                            ->first();

        if ($existingRecord) {
            return response()->json(['message' => 'Registro duplicado'], 409);
        }

        // Crear el nuevo registro
        $newRecord = VisitorInfoxApplicant::create($request->all());
        return response()->json($newRecord, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $record = VisitorInfoxApplicant::find($id);
        if ($record) {
            return response()->json($record);
        } else {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorInfoXApplicant $visitorInfoXApplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $record = VisitorInfoxApplicant::find($id);

        if (!$record) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        // Validar el request
        $request->validate([
            'visitor_type' => 'nullable|in:V,P,B',
            'admitted' => 'boolean',
        ]);

        // Actualizar el registro
        $record->update($request->all());
        return response()->json($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $record = VisitorInfoxApplicant::find($id);

        if (!$record) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $record->delete();
        return response()->json(['message' => 'Registro eliminado']);
    }
}
