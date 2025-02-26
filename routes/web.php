<?php

use App\Http\Controllers\InicialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicialController::class, 'index'])->name('inicial')->middleware('auth');
