<?php

namespace App\Http\Controllers;

use App\Models\applicantURP;
use Illuminate\Http\Request;

class ApplicantURPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applicant = applicantURP::all();
        return response()->json($applicant);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $applicant = applicantURP::create($request->all());
        return response()->json($applicant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $applicant = applicantURP::findOrFail($id);
        return response()->json($applicant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $applicant = applicantURP::findOrFail($id);
        $applicant->update($request->all());
        return response()->json($applicant); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $applicant = applicantURP::findOrFail($id);
        $applicant->delete();
        return response()->json(null, 204);
    }
}
