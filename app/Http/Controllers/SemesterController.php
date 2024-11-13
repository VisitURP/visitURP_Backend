<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = Semester::all();
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
        // Validar todos los campos en una sola llamada
        $validated = $request->validate([
            'semesterName' => [
                'required',
                'regex:/202[0-9]-[0-2]/',
                'string'
            ],
            'semesterFrom' => 'required|date_format:Y-m-d H:i:s',
            'semesterTo' => 'required|date_format:Y-m-d H:i:s|after:semesterFrom',
        ], [
            'semesterName.required' => 'El nombre del semestre es obligatorio.',
            'semesterName.regex' => 'El formato del nombre del semestre no es válido (debe ser 202X-Y).',
            'semesterName.string' => 'El nombre del semestre debe ser una cadena de texto.',
            'semesterFrom.required' => 'La fecha de inicio del semestre es obligatoria.',
            'semesterFrom.date_format' => 'La fecha de inicio debe tener el formato Y-m-d H:i:s.',
            'semesterTo.required' => 'La fecha de finalización del semestre es obligatoria.',
            'semesterTo.date_format' => 'La fecha de finalización debe tener el formato Y-m-d H:i:s.',
            'semesterTo.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio.',
        ]);

        // Crear el registro en la base de datos
        $detail = Semester::create($validated);

        return response()->json($detail, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $semester = Semester::findOrFail($id);
        return response()->json([
            $semester
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $semester = Semester::findOrFail($id);

        $validated = $request->validate([
            'semesterName' => [
                'required',
                'regex:/202[0-9]-[0-2]/',
                'string'
            ],
            'semesterFrom' => 'required|date_format:Y-m-d H:i:s',
            'semesterTo' => 'required|date_format:Y-m-d H:i:s|after:semesterFrom',
        ], [
            'semesterName.required' => 'El nombre del semestre es obligatorio.',
            'semesterName.regex' => 'El formato del nombre del semestre no es válido (debe ser 202X-Y).',
            'semesterName.string' => 'El nombre del semestre debe ser una cadena de texto.',
            'semesterFrom.required' => 'La fecha de inicio del semestre es obligatoria.',
            'semesterFrom.date_format' => 'La fecha de inicio debe tener el formato Y-m-d H:i:s.',
            'semesterTo.required' => 'La fecha de finalización del semestre es obligatoria.',
            'semesterTo.date_format' => 'La fecha de finalización debe tener el formato Y-m-d H:i:s.',
            'semesterTo.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio.',
        ]);
        $semester->update($validated);

        return response()->json($semester, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sem = Semester::findOrFail($id);
        $sem -> delete();

        return response()->json([
            'Message' => 'Semester deleted successfully.'
        ]);
    }
}
