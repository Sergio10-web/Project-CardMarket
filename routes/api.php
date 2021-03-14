<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\VentaController;

use App\Http\Middleware\EnsureTokenIsValid;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('users')->group(function (){

	Route::post('registrar_usuario',[UserController::class,'crear_usuario']);
	Route::post('login_usuario',[UserController::class,'logear_usuario']);
	Route::post('cambiar_contraseña_usuario',[UsuarioController::class,'contraseña_usuario']);
});
Route::prefix('cards')->group(function (){

Route::post('carta_crear',[CardController::class,'crear_carta'])->middleware('ensuretokenisvalid');
});
Route::prefix('collections')->group(function (){

	Route::post('registrar_coleccion',[CollectionController::class,'crear_coleccion'])->middleware('ensuretokenisvalid');

});
Route::prefix('ventas')->group(function (){

	Route::post('registrar_venta',[VentaController::class,'crear_venta']);
	Route::get('ver_lista_ventas/{nombre_venta}',[VentaController::class,'ventas_lista']);
	Route::get('ver_lista_compras/{nombre_venta}',[VentaController::class,'lista_compra']);

});