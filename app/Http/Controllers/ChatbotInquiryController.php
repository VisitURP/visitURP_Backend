<?php

namespace App\Http\Controllers;

use App\Models\ChatbotInquiry;
use Illuminate\Http\Request;

class ChatbotInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inquiry = ChatbotInquiry::all();
        return response()->json($inquiry);
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
            'fk_visitorV_id' => 'required|exists:visitor_v_s,id_visitorV',
            'detail' => 'required|string',
            'state' => 'required|string',
        ]);

        $qa = ChatbotInquiry::create($request->all());

        return response()->json($qa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $inquiry = ChatbotInquiry::find($id);

        if (!$inquiry) {
            return response()->json(['message' => 'Inquiry not found'], 404);
        }

        return response()->json($inquiry);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatbotInquiry $chatbotInquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $chatbotInquiry = ChatbotInquiry::find($id);

        if (!$chatbotInquiry) {
            return response()->json(['message' => 'ChatbotInquiry not found'], 404);
        }

        $request->validate([
            'fk_visitorV_id' => 'required|exists:visitor_v_s,id_visitorV',
            'detail' => 'required|string',
            'state' => 'required|string',
        ]);

        $chatbotInquiry->update($request->all());

        return response()->json($chatbotInquiry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $chatbotInquiry = ChatbotInquiry::find($id);

        if (!$chatbotInquiry) {
            return response()->json(['message' => 'chatbotInquiry not found'], 404);
        }

        $chatbotInquiry->delete();

        return response()->json(['message' => 'chatbotInquiry deleted successfully']);
    }
}
