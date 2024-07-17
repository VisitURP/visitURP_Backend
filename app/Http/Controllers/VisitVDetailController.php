<?php

namespace App\Http\Controllers;

use App\Models\VisitVDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class VisitVDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitVDetail = VisitVDetail::get();

        $data = $visitVDetail->map(function($visitVDetail){
            return [
                'id_visitVDetail' => $visitVDetail -> id_visitVDetail,
                'fk_id_visitV' => $visitVDetail -> fk_id_visitV,
                'fk_id_builtArea' => $visitVDetail -> fk_id_builtArea,
                'kindOfEvent' => $visitVDetail -> kindOfEvent,
                'get' => $visitVDetail -> get,
                'DateTime' => $visitVDetail -> DateTime,
            ];
        });

        //pequeña modificacion
        return response()->json(
            $data
        );
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
        try {
            $validated = $request->validate([
                'fk_id_visitV' => [
                    'required',
                    Rule::exists('visit_v_s', 'id_visitV')->whereNull('deleted_at')
                ],
                'fk_id_builtArea' => [
                    'required',
                    Rule::exists('built_areas', 'id_builtArea')->whereNull('deleted_at')
                ],
                'kindOfEvent' => 'required|max:1',
                'get' => 'required|max:1',
                'DateTime' => 'required|date_format:Y-m-d H:i:s',
            ]);
    
            // Log the validated data
            \Log::info('Validated Data:', $validated);
    
            $visitD = VisitVDetail::create([
                'fk_id_visitV' => $validated['fk_id_visitV'],
                'fk_id_builtArea' => $validated['fk_id_builtArea'],
                'kindOfEvent' => $validated['kindOfEvent'],
                'get' => $validated['get'],
                'DateTime' => Carbon::createFromFormat('Y-m-d H:i:s', $validated['DateTime']),
            ]);
    
            \Log::info('visitD created successfully:', $visitD->toArray());
    
            return response()->json([
                'message' => 'visitD recorded successfully',
                'data' => $visitD
            ], 201);
    
        } catch (\Exception $e) {
            \Log::error('Error storing visitD:', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Error storing visitD',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $visitD = VisitVDetail::findOrFail($id);
        return response()->json([
            $visitD
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitVDetail $visitVDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $visitVDetail)
    {
        $validated = $request->validate([
            'fk_id_visitV' => ['required', Rule::exists('visit_v_s', 'id_visitV')->whereNull('deleted_at')],
            'fk_id_builtArea' => ['required', Rule::exists('built_areas', 'id_builtArea')->whereNull('deleted_at')],
            'kindOfEvent' => ['required', 'max:1'],
            'get' => ['required', 'max:1'],
            'DateTime' => ['required', 'date_format:Y-m-d H:i:s'],
        ]);

        $visitVDetail = VisitVDetail::findOrFail($visitVDetail);
        $visitVDetail-> fk_id_visitV = $validated['fk_id_visitV'];
        $visitVDetail-> fk_id_builtArea = $validated['fk_id_builtArea'];
        $visitVDetail-> kindOfEvent = $validated['kindOfEvent'];
        $visitVDetail-> get = $validated['get'];
        $visitVDetail-> fk_id_builtArea = $validated['fk_id_builtArea'];
        $visitVDetail-> DateTime = $validated['DateTime'];
        $visitVDetail-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'virtual visit Detail : ' => $visitVDetail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $visitVDetail = VisitVDetail::findOrFail($id);
        $visitVDetail -> delete();

        return response()->json([
            'Message' => 'visit detail deleted successfully.'
        ]);
    }
}
