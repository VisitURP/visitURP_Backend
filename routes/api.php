<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\UservisitURPController;
use App\Http\Controllers\VisitorPController;
use App\Http\Controllers\VisitorVController;
use App\Http\Controllers\ChatBot_CategoriesController;
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

//visitorV
Route::get('list-visitorVs', [VisitorVController::class, 'index']);

Route::post('register-visitorV', [VisitorVController::class, 'store']);

Route::get('find-visitorV/{id}', [VisitorVController::class, 'show']);

Route::put('update-visitorV/{id}', [VisitorVController::class, 'update']);

Route::delete('delete-visitorV/{id}', [VisitorVController::class, 'destroy']);

//ChatBot_Categories
Route::get('list-categories', [ChatBot_CategoriesController::class, 'index']);

Route::post('register-category', [ChatBot_CategoriesController::class, 'store']);

Route::get('find-category/{id}', [ChatBot_CategoriesController::class, 'show']);

Route::put('update-category/{id}', [ChatBot_CategoriesController::class, 'update']);

Route::delete('/delete-category/{id}', [ChatBot_CategoriesController::class, 'destroy']);
