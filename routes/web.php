<?php

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CupomDescontoController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::group(['prefix' => 'categoria', 'as' => 'categoria.'], function () {
        Route::get('/', [CategoriaController::class, 'index'])->name('index');
        Route::post('/', [CategoriaController::class, 'store'])->name('store');
        Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('/produtos',ProdutosController::class);
    Route::group(['prefix' => 'produtos', 'as' => 'produtos.'], function () {
        // Formulário de criação de produto
        Route::get('/produtos', [ProdutosController::class, 'index'])->name('index');
        // Inserir um novo produto
        Route::post('/', [ProdutosController::class, 'store'])->name('store');
        // Editar um produto específico
        Route::get('/{produto}/edit', [ProdutosController::class, 'edit'])->name('edit');
        // Atualizar um produto específico
        Route::put('/{produto}', [ProdutosController::class, 'update'])->name('update');
        // Deletar um produto específico
        Route::delete('/{produto}', [ProdutosController::class, 'destroy'])->name('destroy');

    });

    // Rota para o carrinho
    // Route::resource('carrinho', CarrinhoController::class);
    Route::group(['prefix' => 'carrinho', 'as' => 'carrinho.'], function () {
        Route::get('/', [CarrinhoController::class, 'index'])->name('index');
        // Route::post('/', [CarrinhoController::class, 'store'])->name('store');
        Route::post('/finaliza_compra', [CarrinhoController::class, 'finaliza_compras'])->name('finalizar');
        Route::delete('/{carrinho}', [CarrinhoController::class, 'destroy'])->name('destroy');
    });

    Route::post('cupom_desconto', [CupomDescontoController::class, 'store'])->name('cupom_desconto.store');
    Route::delete('cupom_desconto/{id}', [CupomDescontoController::class, 'delete'])->name('cupom_desconto.delete');
});


Route::get('/produtos', [ProdutosController::class, 'produtos_list'])->name('produtos.list');
// inserir no carrinho
Route::post('/carrinho_store', [CarrinhoController::class, 'store'])->name('carrinho.store');


require __DIR__ . '/auth.php';
