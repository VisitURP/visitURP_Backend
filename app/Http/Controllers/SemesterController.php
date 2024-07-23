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
        $validated = $request->validate([
            'semesterName' => 'required',
            'until' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $detail = Semester::create($validated);

        return response()->json($detail, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
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
    public function update(Request $request, int $sem)
    {
        $request->validate([
            'semesterName' => ['required', 'max:500'],
            'until' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $sem = Semester::findOrFail($sem);
        $sem-> semesterName = $request['semesterName'];
        $sem-> until = $request['until'];
        $sem-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'Semester: ' => $sem
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $sem = Semester::findOrFail($id);
        $sem -> delete();

        return response()->json([
            'Message' => 'Semester deleted successfully.'
        ]);
    }
}
