<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Configuração Rotas */

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OperacaoController;
use App\Http\Controllers\OrcamentoController;

Route::middleware(['api'])->group(function () {
    Route::resource('/clientes', ClienteController::class);
    Route::resource('/materiais', MaterialController::class);
    Route::resource('/operacoes', OperacaoController::class);
    Route::resource('/orcamentos', OrcamentoController::class);
});
