<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\Home;

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
| FIT WEB SITE ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/home',[Home::class,'index']);

/*
|--------------------------------------------------------------------------
| FIT PORTAL ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/portal/login', function () {
    return view('portal/login');
});

/*
|--------------------------------------------------------------------------
| FIT ADMIN PORTAL ROUTES
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| FIT STUDENT PORTAL ROUTES
|--------------------------------------------------------------------------
*/
