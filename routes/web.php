<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|   example -   Method 1 -  use App\Http\Controllers\HomeController;
|                           Route::get('/home',[HomeController::class,'indexhome']);
|               Method 2 -  Route::get('/home','App\Http\Controllers\HomeController@indexhome');
*/





/*
|--------------------------------------------------------------------------
| WEBSITE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [App\Http\Controllers\Website\Home::class,'index']);
Route::get('/programme', [App\Http\Controllers\Website\Program::class,'index']);
Route::get('/registration',[App\Http\Controllers\Website\Registration::class,'index']);
Route::get('/learning',[App\Http\Controllers\Website\Learning::class,'index']);
Route::get('/contact',[App\Http\Controllers\Website\Contact::class,'index']);
Route::get('/examination',[App\Http\Controllers\Website\Examination::class,'index']);
Route::get('/faq',[App\Http\Controllers\Website\Faq::class, 'index']);
Route::get('/announcements', [App\Http\Controllers\Website\AnouncementsController::class, 'index']);


/*
|--------------------------------------------------------------------------
| PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| STAFF PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/portal/staff/', [App\Http\Controllers\portal\staff\HomeController::class, 'index'])->name('home');
Route::get('/portal/staff/students', [App\Http\Controllers\portal\staff\StudentController::class, 'index'])->name('students');

Route::get('/portal/staff/exams', [App\Http\Controllers\portal\staff\ExamsController::class, 'index'])->name('exams');
Route::get('exam-list',[App\Http\Controllers\portal\staff\ExamsController::class, 'getExamList'])->name('exams.list');

Route::get('/portal/staff/results', [App\Http\Controllers\portal\staff\ResultsController::class, 'index'])->name('results');
Route::get('/portal/staff/users', [App\Http\Controllers\portal\staff\UsersController::class, 'index'])->name('users');
Route::get('/portal/staff/system', [App\Http\Controllers\portal\staff\SystemController::class, 'index'])->name('system');

/*
|--------------------------------------------------------------------------
| STUDENT PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/portal/student/', [App\Http\Controllers\portal\Student\HomeController::class, 'index']);








