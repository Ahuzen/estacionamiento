<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Vehiculo\RegistroVehiculoController;
use App\Http\Controllers\Oficial\VehiculoOficialController;
use App\Http\Controllers\Residente\VehiculoResidenteController;
use App\Http\Controllers\NoResidente\VehiculoNoResidenteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ruta de login
Route::post('login', [AuthController::class, 'loginUser']);

//ruta para registrar vehiculo oficial o residente
Route::post('register-vehiculo', [RegistroVehiculoController::class, 'register'])->middleware('auth:sanctum')->middleware('auth:sanctum');

//ruta registrar entrada y salida de vehiculo oficial
Route::post('register-vehiculo-oficial', [VehiculoOficialController::class, 'registerVehiculoOficial'])->middleware('auth:sanctum');

//ruta registrar entrada y salida de vehiculo residente
Route::post('register-vehiculo-residente', [VehiculoResidenteController::class, 'registerVehiculoResidente'])->middleware('auth:sanctum');

//ruta registrar entrada y salida de vehiculo no residente
Route::post('register-vehiculo-no-residente', [VehiculoNoResidenteController::class, 'registerVehiculoNoResidente'])->middleware('auth:sanctum');

//informe vehiculos residentes
Route::get('informe-residentes', [VehiculoResidenteController::class, 'informeVehiculoResidente'])->middleware('auth:sanctum');

//reset minutos vehiculos residentes
Route::get('reset-minutos', [VehiculoResidenteController::class, 'resetMinutosResidentes'])->middleware('auth:sanctum');

//eliminar estancia vehiculos oficales
Route::get('eliminar-estancias', [VehiculoOficialController::class, 'eliminarEstanciasVehiculo'])->middleware('auth:sanctum');
