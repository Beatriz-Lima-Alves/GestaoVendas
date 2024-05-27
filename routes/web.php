<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CaixaController;
use App\Http\Controllers\VendasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('home');

Route::get('/home', [VendasController::class, 'productSalesChart'])->middleware(['auth', 'verified'])->name('home');

Route::get('/fornecedor', [FornecedorController::class ,'index'])->middleware(['auth', 'verified'])->name('fornecedor.index');
Route::get('/fornecedor/new', function () {return view('produto/form-fornecedor');})->middleware(['auth', 'verified'])->name('fornecedor.form');
Route::post('/fornecedor/new', [FornecedorController::class ,'store'])->middleware(['auth', 'verified'])->name('fornecedor.store');
Route::get('/fornecedor/{id}/edit/', [FornecedorController::class ,'edit'])->middleware(['auth', 'verified'])->name('fornecedor.edit');
Route::put('/fornecedor/{id}/edit/', [FornecedorController::class ,'update'])->middleware(['auth', 'verified'])->name('fornecedor.update');
Route::put('/fornecedor/{id}/delete/', [FornecedorController::class ,'delete'])->middleware(['auth', 'verified'])->name('fornecedor.delete');

Route::get('/estoque', [EstoqueController::class ,'index'])->middleware(['auth', 'verified'])->name('estoque.index');
Route::post('/estoque/entrada', [EstoqueController::class ,'store'])->middleware(['auth', 'verified'])->name('estoque.store');
Route::post('/estoque/saida', [EstoqueController::class ,'storeMenos'])->middleware(['auth', 'verified'])->name('estoque.storeMenos');
Route::get('/estoque/{id}/detalhes', [EstoqueController::class ,'show'])->middleware(['auth', 'verified'])->name('estoque.show');

Route::get('/produto', [ProdutosController::class ,'index'])->middleware(['auth', 'verified'])->name('produto.index');
Route::get('/produto/new', [ProdutosController::class ,'new'])->middleware(['auth', 'verified'])->name('produto.form');
Route::post('/produto/new', [ProdutosController::class ,'store'])->middleware(['auth', 'verified'])->name('produto.store');
Route::get('/produto/{id}/edit/', [ProdutosController::class ,'edit'])->middleware(['auth', 'verified'])->name('produto.edit');
Route::put('/produto/{id}/edit/', [ProdutosController::class ,'update'])->middleware(['auth', 'verified'])->name('produto.update');
Route::put('/produto/{id}/delete/', [ProdutosController::class ,'delete'])->middleware(['auth', 'verified'])->name('produto.delete');
Route::post('/search/produtos', [ProdutosController::class ,'search'])->name('search.produtos');
Route::get('/api/produtos', [ProdutosController::class ,'getProdutos']);

Route::get('/cliente', [ClienteController::class ,'index'])->middleware(['auth', 'verified'])->name('cliente.index');
Route::get('/cliente/new', function () {return view('cliente/form');})->middleware(['auth', 'verified'])->name('cliente.form');
Route::post('/cliente/new', [ClienteController::class ,'store'])->middleware(['auth', 'verified'])->name('cliente.store');
Route::get('/cliente/{id}/edit/', [ClienteController::class ,'edit'])->middleware(['auth', 'verified'])->name('cliente.edit');
Route::put('/cliente/{id}/edit/', [ClienteController::class ,'update'])->middleware(['auth', 'verified'])->name('cliente.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware(['auth', 'verified'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth', 'verified'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware(['auth', 'verified'])->name('profile.destroy');
});

Route::get('/funcionario', [RegisteredUserController::class ,'index'])->middleware(['auth', 'verified'])->name('funcionario.index');
Route::put('/funcionario/{id}', [RegisteredUserController::class ,'deleteUser'])->middleware(['auth', 'verified'])->name('funcionario.delete');

Route::get('/caixa', [CaixaController::class ,'index'])->middleware(['auth', 'verified'])->name('caixa.index');
Route::match(['get', 'post'], '/caixa/start', [CaixaController::class ,'startSale'])->middleware(['auth', 'verified'])->name('caixa.sale');
Route::match(['get', 'post'], '/caixa/add/{id}', [CaixaController::class ,'addItens'])->middleware(['auth', 'verified'])->name('caixa.add');
Route::post('/caixa/pagamento', [CaixaController::class ,'finalizeSale'])->middleware(['auth', 'verified'])->name('caixa.finalize');
Route::post('/caixa', [CaixaController::class, 'canceledSale'])->name('caixa.cancele');

Route::get('/vendas', [VendasController::class ,'index'])->middleware(['auth', 'verified'])->name('vendas.index');
Route::get('/vendas/{id}/detalhes', [VendasController::class ,'show'])->middleware(['auth', 'verified'])->name('vendas.show');

require __DIR__.'/auth.php';
