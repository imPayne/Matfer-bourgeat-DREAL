<?php

use Illuminate\Support\Facades\Route;
use App\Console\Commands\UpdateDatabase;
use App\Http\Controllers\showController;

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
    return view('welcome');
});

Route::get('/update', [UpdateDatabase::class, 'handle'])->name('handle');

Route::get('/list', [showController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
