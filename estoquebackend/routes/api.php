<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',function($api){
    
    $api->post('/auth/register', 'App\Http\Controllers\Auth\RegisterController@store');
    $api->post('/auth/token', 'App\Http\Controllers\authController@login');

    //Protected Endpoints
    $api->group(['middleware' => 'auth:sanctum'], function ($api) {

        $api->get('/auth/getMe', 'App\Http\Controllers\authController@me');
        $api->post('/auth/logout', 'App\Http\Controllers\authController@logout');

        //Routes Usuarios
        $api->get('/usuarios','App\Http\Controllers\UsuariosController@index');
        $api->post('/usuarios','App\Http\Controllers\UsuariosController@store');
        $api->get('/usuarios/{id}','App\Http\Controllers\UsuariosController@show');
        $api->put('/usuarios/{id}','App\Http\Controllers\UsuariosController@update');

        //Routes Usuarios
        $api->get('/profiles','App\Http\Controllers\ProfilesController@index');

        //Routes Descontos
        $api->post('/descontos','App\Http\Controllers\DescontoController@store');
        $api->get('/descontos','App\Http\Controllers\DescontoController@index');
        $api->put('/descontos/{des_id}','App\Http\Controllers\DescontoController@update');
        $api->delete('/descontos/{des_id}','App\Http\Controllers\DescontoController@destroy');

        //Routes Produtos
        $api->post('/produtos','App\Http\Controllers\ProdutoController@store');
        $api->get('/produtos','App\Http\Controllers\ProdutoController@index');
        $api->get('/produtos/{pro_id}','App\Http\Controllers\ProdutoController@show');
        $api->put('/produtos/{pro_id}','App\Http\Controllers\ProdutoController@update');
        $api->put('/produtos/desativar/{pro_id}','App\Http\Controllers\ProdutoController@desativar');
        $api->delete('/produtos/{pro_id}','App\Http\Controllers\ProdutoController@destroy');


        //Routes Pedidos
        $api->post('/pedidos','App\Http\Controllers\PedidoController@store');
        $api->put('/pedidos/baixa/{id}','App\Http\Controllers\PedidoController@update');
        $api->put('/pedidos/encerrar/{id}','App\Http\Controllers\PedidoController@encerrar');
        $api->get('/pedidos','App\Http\Controllers\PedidoController@index');

        //Routes Produtos_Desconto
        $api->get('/produto_desconto/{id_produto}/{quantidade}/{valor}','App\Http\Controllers\ProdutoDescontoController@GetDescontoProduto');
        $api->delete('/produto_desconto/{pro_id}','App\Http\Controllers\ProdutoDescontoController@destroy');

        //Routes Pedidos_Produtos
        $api->post('/pedidos_produtos','App\Http\Controllers\PedidoProdutosController@store');
        $api->get('/pedidos_produtos/{id}','App\Http\Controllers\PedidoProdutosController@index');
        $api->delete('/pedidos_produtos/{pep_id}','App\Http\Controllers\PedidoProdutosController@destroy');
        $api->put('/pedidos_produtos/baixa/{id}','App\Http\Controllers\PedidoProdutosController@update');
        $api->put('/pedidos_produtos/encerrar/{id}','App\Http\Controllers\PedidoProdutosController@encerrar');

    });

});

Route::get('/', function () {
    return 'Hello World';
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
