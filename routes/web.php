<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');
Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
 
Route::post('/login', 'LoginController@autenticar')->name('site.login');

Route::prefix('/app')->group(function() {
        
    Route::middleware('autenticacao')
        ->get('/home', 'HomeController@index')
        ->name('app.home');

    Route::middleware('autenticacao')
        ->get('/sair', 'LoginController@sair')
        ->name('app.sair');
    Route::middleware('autenticacao')
        ->get('login', 'LoginController@index')
        ->name('login');
    
    /// Produto ///
    Route::middleware('autenticacao:produtos')->resource('/produto','ProdutoController');
    /// Produto Detalhe ///
    Route::middleware('autenticacao:produtos')->resource('produto-detalhe','ProdutoDetalheController');
    
    Route::middleware('autenticacao:produtos')->resource('cliente','ClienteController');
    Route::middleware('autenticacao:produtos')->resource('pedido','PedidoController');
   // Route::middleware('autenticacao:produtos')->resource('pedido-produto','PedidoProdutoController');
    Route::middleware('autenticacao:produtos')->get('pedido-produto/create/{pedido}','PedidoProdutoController@create')->name('pedido-produto.create');
    Route::middleware('autenticacao:produtos')->post('pedido-produto/store/{pedido}','PedidoProdutoController@store')->name('pedido-produto.store');

   /// Fonecedor ///
    Route::middleware('autenticacao:fornecedor')
        ->get('/fornecedor', "FornecedorController@index")
        ->name('app.fornecedor');   
    Route::middleware('autenticacao:fornecedor')
        ->post('/fornecedor/listar', "FornecedorController@listar")
        ->name('app.fornecedor.listar');   
    Route::middleware('autenticacao:fornecedor')
        ->get('/fornecedor/listar', "FornecedorController@listar")
        ->name('app.fornecedor.listar');     
    Route::middleware('autenticacao:fornecedor')
        ->get('/fornecedor/adicionar', "FornecedorController@adicionar")
        ->name('app.fornecedor.adicionar');
    Route::middleware('autenticacao:fornecedor')
        ->post('/fornecedor/adicionar', "FornecedorController@adicionar")
        ->name('app.fornecedor.adicionar');
    Route::middleware('autenticacao:fornecedor')
        ->get('/fornecedor/editar/{id}', "FornecedorController@editar")
        ->name('app.fornecedor.editar');
    Route::middleware('autenticacao:fornecedor')
        ->get('/fornecedor/excluir/{id}', "FornecedorController@excluir")
        ->name('app.fornecedor.excluir');

        //Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
   

});


Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});

