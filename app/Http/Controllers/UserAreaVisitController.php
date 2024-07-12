<?php

namespace App\Http\Controllers;

use App\Models\UserAreaVisit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class UserAreaVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userArea = UserAreaVisit::get();

        $data = $userArea->map(function($userArea){
            return [
                'id_AreaVisit' => $userArea -> id_AreaVisit,
                'fk_id_userV' => $userArea -> fk_id_userV,
                'fk_id_builtArea' => $userArea -> fk_id_builtArea,
                'entered_at' => $userArea -> entered_at,
                'exited_at' => $userArea -> exited_at,
                'duration_seconds' => $userArea -> duration_seconds,
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
            'fk_id_userV' => [
                'required',
                Rule::exists('user_v_s', 'id_userV')->whereNull('deleted_at')
            ],
            'fk_id_builtArea' => [
                'required',
                Rule::exists('built_areas', 'id_builtArea')->whereNull('deleted_at')
            ],
            'entered_at' => 'required|date_format:Y-m-d H:i:s',
            'exited_at' => 'nullable|date_format:Y-m-d H:i:s|after:entered_at',
            'duration_seconds' => 'required',
        ]);

        // Log the validated data
        \Log::info('Validated Data:', $validated);

        $areaVisit = UserAreaVisit::create([
            'fk_id_userV' => $validated['fk_id_userV'],
            'fk_id_builtArea' => $validated['fk_id_builtArea'],
            'entered_at' => Carbon::createFromFormat('Y-m-d H:i:s', $validated['entered_at']),
            'exited_at' => Carbon::createFromFormat('Y-m-d H:i:s', $validated['exited_at']),
            'duration_seconds' => $validated['duration_seconds'],
        ]);

        \Log::info('User Area Visit created successfully:', $areaVisit->toArray());

        return response()->json([
            'message' => 'User Area visit recorded successfully',
            'data' => $areaVisit
        ], 201);

    } catch (\Exception $e) {
        \Log::error('Error storing User Area Visit:', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Error storing User Area visit',
            'error' => $e->getMessage()
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = UserAreaVisit::findOrFail($id);
        return response()->json([
            $user
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAreaVisit $userAreaVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $userAreaVisit)
    {
        $validated = $request->validate([
            'fk_id_userV' => ['required', Rule::exists('user_v_s', 'id_userV')->whereNull('deleted_at')],
            'fk_id_builtArea' => ['required', Rule::exists('built_areas', 'id_builtArea')->whereNull('deleted_at')],
            'entered_at' => ['required', 'date_format:Y-m-d H:i:s'],
            'exited_at' => ['required', 'date_format:Y-m-d H:i:s', 'after:entered_at'],
        ]);

        // Calculate duration in seconds if exited_at is provided
        $duration_seconds = null;
        if ($request->has('exited_at')) {
            $entered_at = new Carbon($validated['entered_at']);
            $exited_at = new Carbon($validated['exited_at']);
            $duration_seconds = $entered_at->diffInSeconds($exited_at);
        }

        $userAreaVisit = UserAreaVisit::findOrFail($userAreaVisit);
        $userAreaVisit-> fk_id_userV = $validated['fk_id_userV'];
        $userAreaVisit-> fk_id_builtArea = $validated['fk_id_builtArea'];
        $userAreaVisit-> entered_at = $validated['entered_at'];
        $userAreaVisit-> exited_at = $validated['exited_at'];
        $userAreaVisit-> duration_seconds = $duration_seconds;
        $userAreaVisit-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'User Area visit: ' => $userAreaVisit
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $userAreaVisit = UserAreaVisit::findOrFail($id);
        $userAreaVisit -> delete();

        return response()->json([
            'Message' => 'User deleted successfully.'
        ]);
    }
}
