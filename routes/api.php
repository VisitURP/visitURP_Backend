<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\UservisitURPController;
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

//uservisitURP
Route::post('register-uservisitURP', [UservisitURPController::class, 'store']);

Route::get('list-uservisitURPs', [UservisitURPController::class, 'index']);

Route::get('find-uservisitURP/{id}', [UservisitURPController::class, 'show']);

Route::put('update-uservisitURP/{id}', [UservisitURPController::class, 'update']);

Route::delete('delete-uservisitURP/{id}',[UservisitURPController::class, 'destroy']);
