<?php

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarrinhoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('/produtos',ProdutosController::class);
    Route::group(['prefix' => 'produtos', 'as' => 'produtos.'], function () {
        // Exibir a lista de produtos
        Route::get('/', [ProdutosController::class, 'index'])->name('index');

        // Formulário de criação de produto
        Route::get('/create', [ProdutosController::class, 'create'])->name('create');

        // Inserir um novo produto
        Route::post('/', [ProdutosController::class, 'store'])->name('store');

        // Editar um produto específico
        Route::get('/{produto}/edit', [ProdutosController::class, 'edit'])->name('edit');

        // Atualizar um produto específico
        Route::put('/{produto}', [ProdutosController::class, 'update'])->name('update');

        // Deletar um produto específico
        Route::delete('/{produto}', [ProdutosController::class, 'destroy'])->name('destroy');

        // Rota opcional se produtos_list for necessária (não é recomendada se já tiver o index)
        Route::get('/produtos_list', [ProdutosController::class, 'produtos_list'])->name('list');

    });

    // Rota para o carrinho
    // Route::resource('carrinho', CarrinhoController::class);
    Route::group(['prefix' => 'carrinho', 'as' => 'carrinho.'], function () {
        Route::get('/', [CarrinhoController::class, 'index'])->name('index');
        Route::post('/', [CarrinhoController::class, 'store'])->name('store');
        Route::post('/finaliza_compra', [CarrinhoController::class, 'finaliza_compras'])->name('finalizar');
        Route::delete('/{carrinho}', [CarrinhoController::class, 'destroy'])->name('destroy');
    });

});

require __DIR__.'/auth.php';
