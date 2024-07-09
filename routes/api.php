<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\UservisitURPController;
use App\Http\Controllers\VisitorPController;
use App\Http\Controllers\VisitorVController;
use App\Http\Controllers\ChatBot_CategoriesController;
use App\Http\Controllers\ChatBot_QAController;
use App\Http\Controllers\ChatBot_InquiryController;
use App\Http\Controllers\ApplicantURPController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitXapplicantController;
use App\Http\Controllers\AcademicInterestController;
use App\Http\Controllers\BuiltAreaController;
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

//ChatBot_Category
Route::get('list-categories', [ChatBot_CategoriesController::class, 'index']);

Route::post('register-category', [ChatBot_CategoriesController::class, 'store']);

Route::get('find-category/{id}', [ChatBot_CategoriesController::class, 'show']);

Route::put('update-category/{id}', [ChatBot_CategoriesController::class, 'update']);

Route::delete('delete-category/{id}', [ChatBot_CategoriesController::class, 'destroy']);

//ChatBot_QA
Route::get('list-qa', [ChatBot_QAController::class, 'index']);

Route::post('register-qa', [ChatBot_QAController::class, 'store']);

Route::get('find-qa/{id}', [ChatBot_QAController::class, 'show']);

Route::put('update-qa/{id}', [ChatBot_QAController::class, 'update']);

Route::delete('delete-qa/{id}', [ChatBot_QAController::class, 'destroy']);

//ChatBot_inquiry
Route::get('list-inquiry', [ChatBot_InquiryController::class, 'index']);

Route::post('register-inquiry', [ChatBot_InquiryController::class, 'store']);

Route::get('find-inquiry/{id}', [ChatBot_InquiryController::class, 'show']);

Route::put('update-inquiry/{id}', [ChatBot_InquiryController::class, 'update']);

Route::delete('delete-inquiry/{id}', [ChatBot_InquiryController::class, 'destroy']);

//applicant
Route::get('list-applicants', [ApplicantURPController::class, 'index']);

Route::post('register-applicant', [ApplicantURPController::class, 'store']);

Route::get('find-applicant/{id}', [ApplicantURPController::class, 'show']);

Route::put('update-applicant/{id}', [ApplicantURPController::class, 'update']);

Route::delete('delete-applicant/{id}', [ApplicantURPController::class, 'destroy']);

//visit table
Route::get('sync-visits', [VisitController::class, 'syncVisits']);

Route::get('list-visits', [VisitController::class, 'index']);

Route::get('find-visit/{id}', [VisitController::class, 'show']);

Route::put('update-visit/{id}', [VisitController::class, 'update']);

Route::delete('delete-visit/{id}', [VisitController::class, 'destroy']);

//visit X applicant table
Route::get('sync-visitXapplicants', [VisitXapplicantController::class, 'syncVisitXapplicants']);

Route::get('list-visitXapplicants', [VisitXapplicantController::class, 'index']);

Route::get('find-visitXapplicant/{id}', [VisitXapplicantController::class, 'show']);

Route::put('update-visitXapplicant/{id}', [VisitXapplicantController::class, 'update']);

Route::delete('delete-visitXapplicant/{id}', [VisitXapplicantController::class, 'destroy']);


//academicInterest table
Route::post('register-academicInterest', [AcademicInterestController::class, 'store']);

Route::get('list-academicInterests', [AcademicInterestController::class, 'index']);

Route::get('find-academicInterest/{id}', [AcademicInterestController::class, 'show']);

Route::put('update-academicInterest/{id}', [AcademicInterestController::class, 'update']);

Route::delete('delete-academicInterest/{id}', [AcademicInterestController::class, 'destroy']);

//builtArea table
Route::post('register-builtArea', [BuiltAreaController::class, 'store']);

Route::get('list-builtAreas', [BuiltAreaController::class, 'index']);

Route::get('find-builtArea/{id}', [BuiltAreaController::class, 'show']);

Route::put('update-builtArea/{id}', [BuiltAreaController::class, 'update']);

Route::delete('delete-builtArea/{id}', [BuiltAreaController::class, 'destroy']);

