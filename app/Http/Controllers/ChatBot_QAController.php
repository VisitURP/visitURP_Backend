<?php

namespace App\Http\Controllers;

use App\Models\chatbot_QA;
use Illuminate\Http\Request;

class ChatBot_QAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qa = chatbot_QA::all();
        return response()->json($qa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $qa = chatbot_QA::create($request->all());
        return response()->json($qa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $qa = chatbot_QA::findOrFail($id);
        return response()->json($qa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $qa = chatbot_QA::findOrFail($id);
        $qa->update($request->all());
        return response()->json($qa); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $qa = chatbot_QA::findOrFail($id);
        $qa->delete();
        return response()->json(null, 204);
    }
}
