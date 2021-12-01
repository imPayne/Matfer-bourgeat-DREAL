<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZoneController;

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

Route::get('/', function () {
    return view('layout');
});

Route::get('/zones', [ZoneController::class, 'index']);

Route::get('/search', function () {
    return view('search');
});

Route::get('/home', function () {
    return view('home');
});