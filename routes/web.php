<?php

use App\Http\Controllers\CepController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rotas Autenticadas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/meu-cadastro', [UserController::class, 'meu_cadastro'])->name('meu-cadastro');
    Route::get('/contatos', [ContatosController::class, 'listar'])->name('contatos');
});

//Administrador
Route::middleware('AdminMiddleware')->group(function () {
    Route::get('/listar-usuarios', [UserController::class, 'listar'])->name('listar-usuarios  ');
});

//Rotas de API
Route::get('api/cep/{id}', [CepController::class, 'get'])->middleware(ApiMiddleware::class);
