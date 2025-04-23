<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\UsuarioController;

Route::prefix('medicos')->group(function () {
    Route::post('/cadastrar', [MedicoController::class, 'cadastrar']);
    Route::put('/atualizar/{id}', [MedicoController::class, 'atualizar']);
    Route::get('/consultar/{id?}', [MedicoController::class, 'consultar']);
});

Route::prefix('usuarios')->group(function () {
    Route::post('/cadastrar', [UsuarioController::class, 'cadastrar']);
    Route::put('/atualizar/{id}', [UsuarioController::class, 'atualizar']);
    Route::get('/consultar/{id?}', [UsuarioController::class, 'consultar']);
});
