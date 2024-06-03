<?php

namespace App\Http\Controllers;

use App\Models\chatbot_inquiry;
use Illuminate\Http\Request;

class ChatBot_InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inquiry = chatbot_inquiry::all();
        return response()->json($inquiry);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inquiry = chatbot_inquiry::create($request->all());
        return response()->json($inquiry, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inquiry = chatbot_inquiry::findOrFail($id);
        return response()->json($inquiry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $inquiry = chatbot_inquiry::findOrFail($id);
        $inquiry->update($request->all());
        return response()->json($inquiry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $inquiry = chatbot_inquiry::findOrFail($id);
        $inquiry->delete();
        return response()->json(null, 204);
    }
}
