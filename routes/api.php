<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\userURPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//docType
Route::post('register-docType', [DocTypeController::class, 'store']);

Route::get('list-docTypes', [DocTypeController::class, 'index']);

Route::get('find-docType/{id}', [DocTypeController::class, 'show']);

Route::put('update-docType/{id}', [DocTypeController::class, 'update']);

Route::delete('delete-docType/{id}',[DocTypeController::class, 'destroy']);

//userURP
Route::post('register-userURP', [userURPController::class, 'store']);

Route::get('list-userURPs', [userURPController::class, 'index']);

Route::get('find-userURP/{id}', [userURPController::class, 'show']);

Route::put('update-userURP/{id}', [userURPController::class, 'update']);

Route::delete('delete-userURP/{id}',[userURPController::class, 'destroy']);
