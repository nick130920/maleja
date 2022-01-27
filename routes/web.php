<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;

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
    return view('index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::post('/calendar', [CalendarController::class, 'create'])->name('calendar');
    Route::resource('/services', ServiceController::class);
    Route::resource('/producto', ProductoController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::middleware(['admin'])->prefix('/admin')->namespace('Admin')->group(function(){
    Route::get('/', 'productosController@crear')->name('crear');
    
}); 

require __DIR__.'/auth.php';


