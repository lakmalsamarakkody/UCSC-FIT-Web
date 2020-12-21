<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mobileapp\RegUsersController;
use App\Http\Controllers\Mobileapp\ResultOverviewController;
use App\Http\Controllers\Mobileapp\StudentExamController;
use App\Http\Controllers\Mobileapp\StduentDetailsController;
use App\Http\Controllers\Mobileapp\SubjectController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("reguserCount",[RegUsersController::class,'countRegUser']);
Route::get('examSchedule',[StudentExamController::class,'examSchedule']);
Route::get('studentDetails/{id}',[StduentDetailsController::class,'studentDetails']);
Route::get('searchStudents',[StduentDetailsController::class,'searchStudents']);
Route::get('subjectDetails',[SubjectController::class,'subjectDetails']);
Route::get('subjectresult/{id}/{year?}/{month?}',[SubjectController::class,'subjectresult']);
Route::get('resultoverview/{year?}',[ResultOverviewController::class,'resultoverview']);
