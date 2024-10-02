<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\ImagenColorController;
use App\Models\ImagenColorUña;

//LLAMADA A FUNCIONES


//LOGIN
Route::post('/login', [ConsultasController::class, 'login']);
//REGISTRO
Route::post('/registro', [ConsultasController::class, 'registro']);
//CIERRE SESSION
Route::post('/logout', [ConsultasController::class, 'logout'])->name('logout');
//AÑADIR CARRITO 
Route::post('/carrito', [ConsultasController::class, 'carrito'])->name('carrito');
//PONER INFORMACION COMPRA
Route::post('/insertar-info-compra', [ConsultasController::class, 'insertarInfoCompra'])->name('insertarInfoCompra');
//ELIMINAR COMPRA
Route::post('/eliminar-compra', [ConsultasController::class, 'eliminarCompra'])->name('eliminarCompra');
//BUSCADOR
Route::get('/filtrar-uñas', [ConsultasController::class, 'filtrarUñas'])->name('filtrar_uñas');


//MOVIMIENTO ENTRE PESTAÑAS
Route::get('/',function(){
    return view('home');
})->name('home');


//MENU

Route::get('/uñas', [ConsultasController::class, 'obtenerUñas'])->name('uñas');

Route::get('/uñas/{nombre}', [ConsultasController::class, 'detallarUñas'])->name('detallar_uñas');


Route::get('/maquillaje',function(){
    return view('maquillaje');
})->name('maquillaje');


Route::get('/peinado',function(){
    return view('peinado');
})->name('peinado');


//RESTO
Route::get('/login',function(){
    return view('login');
})->name('login');


Route::get('/registro',function(){
    return view('registro');
})->name('registro');


Route::get('/carrito', [ConsultasController::class, 'mostrarCompras'])->name('carrito');





