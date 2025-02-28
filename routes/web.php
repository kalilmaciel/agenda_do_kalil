<?php

use App\Http\Controllers\CepController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

//Rotas Autenticadas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/meu-cadastro', [UserController::class, 'meu_cadastro'])->name('meu-cadastro');

    Route::get('/contatos', [ContatosController::class, 'listar'])->name('contatos');
    Route::post('/contatos', [ContatosController::class, 'listar'])->name('contatos');
    Route::get('/contato/{id}', [ContatosController::class, 'detalhar'])->name('detalhar-contato');
    Route::post('/contato', [ContatosController::class, 'salvar'])->name('salvar-contato');

    Route::get('/sair', function () {
        session()->flush();
        return redirect()->route('login')->with('success', 'Você saiu do sistema.');
    })->name('sair');
});

//Administrador
Route::middleware('AdminMiddleware')->group(function () {
    Route::get('/listar-usuarios', [UserController::class, 'listar'])->name('listar-usuarios  ');
});

//Rotas de API
Route::get('api/cep/{cep}', [CepController::class, 'get'])->middleware(ApiMiddleware::class);
Route::post('api/localizacaoDireta', [MapaController::class, 'getDireta'])->middleware(ApiMiddleware::class);
Route::post('api/localizacaoReversa', [MapaController::class, 'getReversa'])->middleware(ApiMiddleware::class);
