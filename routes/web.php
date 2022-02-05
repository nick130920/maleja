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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [HomeController::class, 'home']);

Route::middleware(['auth'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::post('/calendar', [CalendarController::class, 'create'])->name('calendar');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

});


Route::middleware(['admin'])->prefix('/admin')->group(function(){
    Route::resource('services', ServiceController::class);
    // Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    // Route::get('/services', [ServiceController::class, 'create']);
    // Route::post('/services', [ServiceController::class, 'store'])->name('/services/store');
    // Route::get('/services/editar/{id}',[ServiceController::class,'edit'])->name('/services/editar');//(EDITAR) formulario edición
    // Route::patch('/services/editar/{id}', [ServiceController::class, 'update']);                //(ACTUALIZAR)  Actualizar clase
    // Route::get('/services/{id}', [ServiceController::class, 'show'])->name('/services/show');   //(VER)   UNA CLASE
    // Route::delete('/services/{id}', [ServiceController::class,'destroy'])->name('/services/destroy');

    //Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('/productos');           //(VISTA) de los productos en Administrador
    Route::get('/producto/crear',[ProductoController::class,'create'])->name('/producto/crear');   //(VISTA) Creacion de productos
    Route::post('/producto', [ProductoController::class, 'store'])->name('/producto/store');        //(REGISTRO) la creación de producto
    Route::get('/producto/editar/{id}',[ProductoController::class,'edit'])->name('/producto/editar');//(EDITAR) formulario edición
    Route::patch('/producto/editar/{id}', [ProductoController::class, 'update']);                     //(ACTUALIZAR)  Actualizar clase
    Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('/producto/show');        //(VER)   UNA CLASE
    Route::delete('/producto/{id}', [ProductoController::class,'destroy'])->name('/producto/destroy');//(ELIMINAR)     Eliminar clase
});

require __DIR__.'/auth.php';


