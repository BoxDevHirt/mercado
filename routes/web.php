<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientMercadoController;
use Illuminate\Support\Facades\Route;


/**
 * Rota coringa 
 * @Route - Rota de fallback
 */
Route::fallback(function () {
    if (!auth()->check()) {
        return redirect('/client');
    }
    abort(404); 
});


/**
 * Rota coringa de inicialização
 * @Route - redirecionamento automático para /client
 */
route::redirect('/', '/client');

/**
 * Rota utilizada para conectar a parte do cliente
 * @Route::prefix - Grupo do cliente. Tudo que for visivel para o cliente
 */
Route::prefix('client')->group(function () {
    /**
     * @Routes - Rotas relacionadas ao painel preços de produtos
     */
    Route::get('/', [ClientMercadoController::class, 'index'])->name('client');

    /**
     * @Routes - Rotas relacionadas ao login
     */
    Route::get('/login', [AuthController::class, 'index'])->name('client.login');
    Route::post('/login', [AuthController::class, 'post'])->name('client.login.post');
});

/**
 * Rota utilizada para conectar a parte administrativa
 * @Route::prefix - Grupo do administrador. Tudo que visivel para o administrador
 */
Route::middleware('auth')->prefix('admin')->group(function () {
    /**
     * @Route - Rotas relacionadas a painel administrativo inicial
     */
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::post('/logout', [AdminController::class, 'post'])->name('admin.logout');
});
