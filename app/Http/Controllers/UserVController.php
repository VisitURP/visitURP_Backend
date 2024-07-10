<?php

namespace App\Http\Controllers;

use App\Models\userV;
use Illuminate\Http\Request;

class UserVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = userV::get();

        $data = $user->map(function($user){
            return [
                'id_userV' => $user -> id_userV,
                'name' => $user -> name,
                'email' => $user -> email,
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
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email']
        ]);

        if($request)
        {
            $userV = userV::create([
                'name' => $request['name'],
                'email' => $request['email'],
            ]);
    
            return response()->json([
                $userV
            ]);
        }
        else
        {
            return response()->json([
                'Use a correct email format.',
            ]);
        }

        // $email = uservisitURP::where('email', $request->email)->first();
        

        // //si es que existe username
        // if($userName)
        // {
        //     if($email)
        //     {
        //         return response()->json([
        //             'I´m sorry, username and email already exist.',
        //         ]);
        //     }
        //     else
        //     {
        //         return response()->json([
        //             'I´m sorry, username already exist.',
        //         ]);
        //     }
        // }
        // //si es que NO existe username
        // else
        // {
        //     if($email)
        //     {
        //         return response()->json([
        //             'I´m sorry, email already exist.',
        //         ]);
        //     }
        //     //no existe username ni email
        //     else
        //     {
        //         $request->validate([
        //             'name' => ['required', 'max:100'],
        //             'lastName' => ['required', 'max:200'],
        //             'email' => ['required', 'email'],
        //             'rol' => ['required', 'max:100'],
        //             'username' => ['required', 'max:100'],
        //             'password' => ['required', 'max:100'],
        //             'fk_docType_id' => ['required', 'max:100'],
        //             'docNumber' => ['required', 'max:100'],
        //             'phone' => ['required', 'numeric', 'min:9']
        //         ]);
    
        //         $user = uservisitURP::create([
        //             'name' => $request['name'],
        //             'lastName' => $request['lastName'],
        //             'email' => $request['email'],
        //             'rol' => $request['rol'],
        //             'username' => $request['username'],
        //             'password' => $request['password'],
        //             'fk_docType_id' => $request['fk_docType_id'],
        //             'docNumber' => $request['docNumber'],
        //             'phone' => $request['phone']
        //         ]);
    
        //         return response()->json([
        //             $user
        //         ]);
        //     }
        // }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = userV::findOrFail($id);
        return response()->json([
            $user
        ] 
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(userV $userV)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $userV)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email'],
        ]);

        $userV = userV::findOrFail($userV);
        $userV-> name = $request['name'];
        $userV-> email = $request['email'];
        $userV-> save();

        return response()->json([
            'Message' => 'Data already updated.',
            'User visitor: ' => $userV
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $userV = userV::findOrFail($id);
        $userV -> delete();

        return response()->json([
            'Message' => 'User deleted successfully.'
        ]);
    }
}
