<?php

use App\Http\Controllers\Website\AnouncementsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Website\Home;
use App\Http\Controllers\Website\Program;
use App\Http\Controllers\Website\Registration;
use App\Http\Controllers\Website\Learning;
use App\Http\Controllers\Website\Contact;
use App\Http\Controllers\Website\Examination;
use App\Http\Controllers\Website\Faq;

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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Home::class,'index']);

Route::get('/programme', [Program::class,'index']);

Route::get('/registration',[Registration::class,'index']);

Route::get('/learning',[Learning::class,'index']);

Route::get('/contact',[Contact::class,'index']);

Route::get('/examination',[Examination::class,'index']);

Route::get('/faq',[Faq::class, 'index']);

Route::get('/announcements', [AnouncementsController::class, 'index']);


/*
|--------------------------------------------------------------------------
| PORTAL ROUTES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ADMIN PORTAL ROUTES
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| STUDENT PORTAL ROUTES
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/portal/staff/', [App\Http\Controllers\portal\staff\HomeController::class, 'index'])->name('home');

Route::get('exam-list',[App\Http\Controllers\portal\staff\ExamsController::class, 'getExamList']);

Route::get('/portal/staff/students', [App\Http\Controllers\portal\staff\StudentController::class, 'index'])->name('students');

Route::get('/portal/staff/exams', [App\Http\Controllers\portal\staff\ExamsController::class, 'index'])->name('exams');

Route::get('/portal/staff/results', [App\Http\Controllers\portal\staff\ResultsController::class, 'index'])->name('results');

Route::get('/portal/staff/users', [App\Http\Controllers\portal\staff\UsersController::class, 'index'])->name('users');

Route::get('/portal/staff/system', [App\Http\Controllers\portal\staff\SystemController::class, 'index'])->name('system');

Route::get('/portal/student/', [App\Http\Controllers\portal\Student\HomeController::class, 'index']);
