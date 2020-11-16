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
*/


/*
|--------------------------------------------------------------------------
| FIT WEB SITE ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('website/home');
});

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
