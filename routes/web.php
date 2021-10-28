<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;


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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index', function () {
   return view('index');
})->name('index');

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::post('/calendar', [CalendarController::class, 'create'])->name('calendar');
    // Route::get('/services',[ServicioController::class, 'index']);
    Route::resource('/services', ServiceController::class);
});



Route::get('/home', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';


Route::get('/home', [HomeController::class, 'index'])->name('home');
