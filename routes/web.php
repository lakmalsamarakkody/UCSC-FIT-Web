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
// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\Website\Home;
Route::get('/', [Home::class,'index']);

use App\Http\Controllers\Website\Program;
Route::get('/programme', [Program::class,'index']);

/*
|--------------------------------------------------------------------------
| PORTAL ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Portal\Login;

Route::get('/portal/login', [Login::class,'index']);

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
