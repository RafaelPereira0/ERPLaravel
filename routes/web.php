<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoEstoqueController;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('/clientes', ClienteController::class)->middleware(['auth']);
Route::resource('/fornecedores', FornecedorController::class)->middleware(['auth']);
Route::resource('/produtos', ProdutoController::class)->middleware(['auth']);
Route::post('estoques/store', [ProdutoEstoqueController::class, 'store'])->name('estoques.store');
Route::resource('/estoque', ProdutoEstoqueController::class)->middleware(['auth'])->except('store');



Route::resource('/movimentacoes', MovimentacaoController::class)->middleware(['auth']);




Route::resource('/admin', AdminController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
