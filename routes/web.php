<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoEstoqueController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Recursos principais
    Route::resources([
        'clientes' => ClienteController::class,
        'fornecedores' => FornecedorController::class,
        'produtos' => ProdutoController::class,
        'movimentacoes' => MovimentacaoController::class,
        'admin' => AdminController::class,
    ]);

    // Estoque
    Route::prefix('estoque')->name('estoque.')->group(function () {
        Route::post('store', [ProdutoEstoqueController::class, 'store'])->name('store');
        Route::resource('/', ProdutoEstoqueController::class)->except('store');
    });
});

require __DIR__.'/auth.php';
