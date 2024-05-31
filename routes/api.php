<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\UservisitURPController;
use App\Http\Controllers\VisitorPController;
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

//visitorP
Route::post('register-visitorP', [VisitorPController::class, 'store']);

Route::get('list-visitorPs', [VisitorPController::class, 'index']);

Route::get('find-visitorP/{id}', [VisitorPController::class, 'show']);

Route::put('update-visitorP/{id}', [VisitorPController::class, 'update']);

Route::delete('delete-visitorP/{id}',[VisitorPController::class, 'destroy']);
