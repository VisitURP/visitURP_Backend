<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\UservisitURPController;
use App\Http\Controllers\VisitorPController;
use App\Http\Controllers\VisitorVController;
use App\Http\Controllers\ChatbotCategorieController;
use App\Http\Controllers\ChatBot_QAController;
use App\Http\Controllers\ChatBot_InquiryController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\VisitXapplicantController;
use App\Http\Controllers\AcademicInterestController;
use App\Http\Controllers\BuiltAreaController;
use App\Http\Controllers\UserVController;
use App\Http\Controllers\UserAreaVisitController;
use App\Http\Controllers\VisitVController;
use App\Http\Controllers\VisitVDetailController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\VisitorPreferenceController;
use App\Http\Controllers\UserPrivacyPreferencesController;
use App\Http\Controllers\InteractiveFeedbacksController;
use App\Http\Controllers\VisitorInfoController;
use App\Http\Controllers\VisitorInfoXapplicantController;
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
Route::get('list-categories', [ChatbotCategorieController::class, 'index']);

Route::post('register-category', [ChatbotCategorieController::class, 'store']);

Route::get('find-category/{id}', [ChatbotCategorieController::class, 'show']);

Route::put('update-category/{id}', [ChatbotCategorieController::class, 'update']);

Route::delete('delete-category/{id}', [ChatbotCategorieController::class, 'destroy']);

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
Route::get('list-applicants', [ApplicantController::class, 'index']);

Route::post('register-applicant', [ApplicantController::class, 'store']);

Route::get('find-applicant/{id}', [ApplicantController::class, 'show']);

Route::put('update-applicant/{id}', [ApplicantController::class, 'update']);

Route::delete('delete-applicant/{id}', [ApplicantController::class, 'destroy']);


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


//user visitor table
Route::post('register-userV', [UserVController::class, 'store']);

Route::get('list-usersV', [UserVController::class, 'index']);

Route::get('find-userV/{id}', [UserVController::class, 'show']);

Route::put('update-userV/{id}', [UserVController::class, 'update']);

Route::delete('delete-userV/{id}', [UserVController::class, 'destroy']);


//visitV table
Route::post('register-visitV', [VisitVController::class, 'store']);

Route::get('list-visitVs', [VisitVController::class, 'index']);

Route::get('find-visitV/{id}', [VisitVController::class, 'show']);

Route::put('update-visitV/{id}', [VisitVController::class, 'update']);

Route::delete('delete-visitV/{id}', [VisitVController::class, 'destroy']);

//visitVdetail table
Route::post('register-visitVD', [VisitVDetailController::class, 'store']);

Route::get('list-visitVD', [VisitVDetailController::class, 'index']);

Route::get('find-visitVD/{id_visitVDetail}', [VisitVDetailController::class, 'show']);

Route::put('update-visitVD/{id_visitVDetail}', [VisitVDetailController::class, 'update']);

Route::delete('delete-visitVD/{id_visitVDetail}', [VisitVDetailController::class, 'destroy']);

//semester table
Route::post('register-semester', [SemesterController::class, 'store']);

Route::get('list-semester', [SemesterController::class, 'index']);

Route::get('find-semester/{id_semester}', [SemesterController::class, 'show']);

Route::put('update-semester/{id_semester}', [SemesterController::class, 'update']);

Route::delete('delete-semester/{id_semester}', [SemesterController::class, 'destroy']);

//visitorPreferences table
Route::post('register-visitorPreference', [VisitorPreferenceController::class, 'store']);

Route::get('list-visitorPreference', [VisitorPreferenceController::class, 'index']);

Route::get('find-visitorPreference/{id}', [VisitorPreferenceController::class, 'show']);

Route::put('update-visitorPreference/{id}', [VisitorPreferenceController::class, 'update']);

Route::delete('delete-visitorPreference/{id}', [VisitorPreferenceController::class, 'destroy']);

//userprivacyPreferences table
Route::post('register-UserPrivacyPreference', [UserPrivacyPreferencesController::class, 'store']);

Route::get('list-UserPrivacyPreference', [UserPrivacyPreferencesController::class, 'index']);

Route::get('find-UserPrivacyPreference/{id}', [UserPrivacyPreferencesController::class, 'show']);

Route::put('update-UserPrivacyPreference/{id}', [UserPrivacyPreferencesController::class, 'update']);

Route::delete('delete-UserPrivacyPreference/{id}', [UserPrivacyPreferencesController::class, 'destroy']);


//interactiveFeedbacks table
Route::post('register-interactiveFeedback', [InteractiveFeedbacksController::class, 'store']);

Route::get('list-interactiveFeedbacks', [InteractiveFeedbacksController::class, 'index']);

Route::get('find-interactiveFeedbacks/{id}', [InteractiveFeedbacksController::class, 'show']);

Route::put('update-interactiveFeedbacks/{id}', [InteractiveFeedbacksController::class, 'update']);

Route::delete('delete-interactiveFeedbacks/{id}', [InteractiveFeedbacksController::class, 'destroy']);


//visitorInfo table
Route::post('register-visitorInfo', [VisitorInfoController::class, 'store']);

Route::get('list-visitorInfos', [VisitorInfoController::class, 'index']);

Route::get('find-visitorInfo/{id}', [VisitorInfoController::class, 'show']);

Route::put('update-visitorInfo/{id}', [VisitorInfoController::class, 'update']);

Route::delete('delete-visitorInfo/{id}', [VisitorInfoController::class, 'destroy']);


//visitorInfo x applicant table
Route::post('register-VxA', [VisitorInfoXapplicantController::class, 'store']);

Route::get('list-VxAs', [VisitorInfoXapplicantController::class, 'index']);

Route::get('find-VxA/{id}', [VisitorInfoXapplicantController::class, 'show']);

Route::put('update-VxA/{id}', [VisitorInfoXapplicantController::class, 'update']);

Route::delete('delete-VxA/{id}', [VisitorInfoXapplicantController::class, 'destroy']);
