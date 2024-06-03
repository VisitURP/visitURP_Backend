<?php

namespace App\Http\Controllers;

use App\Models\chatbot_categories;
use Illuminate\Http\Request;

class Chatbot_CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = chatbot_categories::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = chatbot_categories::create($request->all());
        return response()->json($categories, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = chatbot_categories::findOrFail($id);
        return response()->json($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $categories = chatbot_categories::findOrFail($id);
        $categories->update($request->all());
        return response()->json($categories); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $categories = chatbot_categories::findOrFail($id);
        $categories->delete();
        return response()->json(null, 204);
    }
}
