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

/* Configuração Rotas */

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OperacaoController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Rotas públicas (não requerem autenticação)
Route::post('/admin/login', [AuthController::class, 'loginAdmin']);

// Rotas protegidas por autenticação via Sanctum
Route::middleware(['api'])->group(function () {
    // Rotas para clientes
    Route::resource('/clientes', ClienteController::class);

    // Rotas para materiais
    Route::resource('/materiais', MaterialController::class);

    // Rotas para operações
    Route::resource('/operacoes', OperacaoController::class);

    // Rotas para orçamentos
    Route::resource('/orcamentos', OrcamentoController::class);
    Route::resource('/clientes', ClienteController::class)->only(['index']);
    Route::resource('/materiais', MaterialController::class)->only(['index']);
    Route::resource('/operacoes', OperacaoController::class)->only(['index']);
    Route::get('/dashboard/horas-operacoes', [DashboardController::class, 'totalHorasPorOperacao']);

    // Rota de logout
    Route::post('/admin/logout', [AuthController::class, 'logoutAdmin']);
});
