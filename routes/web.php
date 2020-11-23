<?php

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

Route::get('/welcome',[Faq::class, 'index']);


/*
|--------------------------------------------------------------------------
| PORTAL ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Portal\Login;

Route::get('/login', [Login::class,'index']);

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
