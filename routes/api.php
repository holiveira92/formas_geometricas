<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Rotas para triangulo
Route::get('triangulo', [App\Http\Controllers\TrianguloController::class, 'index']);
Route::get('triangulo/{id}', [App\Http\Controllers\TrianguloController::class, 'show']);
Route::post('triangulo', [App\Http\Controllers\TrianguloController::class, 'insert']);
Route::put('triangulo/{id}', [App\Http\Controllers\TrianguloController::class, 'update']);
Route::delete('triangulo/{id}', [App\Http\Controllers\TrianguloController::class, 'delete']);
Route::get('triangulo/', [App\Http\Controllers\TrianguloController::class, 'index']);
Route::get('triangulo/{id}/', [App\Http\Controllers\TrianguloController::class, 'show']);
Route::post('triangulo/', [App\Http\Controllers\TrianguloController::class, 'insert']);
Route::put('triangulo/{id}/', [App\Http\Controllers\TrianguloController::class, 'update']);
Route::delete('triangulo/{id}/', [App\Http\Controllers\TrianguloController::class, 'delete']);

//Rotas para retângulo
Route::get('retangulo', [App\Http\Controllers\RetanguloController::class, 'index']);
Route::get('retangulo/{id}', [App\Http\Controllers\RetanguloController::class, 'show']);
Route::post('retangulo', [App\Http\Controllers\RetanguloController::class, 'insert']);
Route::put('retangulo/{id}', [App\Http\Controllers\RetanguloController::class, 'update']);
Route::delete('retangulo/{id}', [App\Http\Controllers\RetanguloController::class, 'delete']);
Route::get('retangulo/', [App\Http\Controllers\RetanguloController::class, 'index']);
Route::get('retangulo/{id}/', [App\Http\Controllers\RetanguloController::class, 'show']);
Route::post('retangulo/', [App\Http\Controllers\RetanguloController::class, 'insert']);
Route::put('retangulo/{id}/', [App\Http\Controllers\RetanguloController::class, 'update']);
Route::delete('retangulo/{id}/', [App\Http\Controllers\RetanguloController::class, 'delete']);

//Rotas para cálculo de áreas dos polígonos
Route::get('area_poligonos', [App\Http\Controllers\AreaPoligonosController::class, 'index']);
Route::get('area_poligonos/', [App\Http\Controllers\AreaPoligonosController::class, 'index']);