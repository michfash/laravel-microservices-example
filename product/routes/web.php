<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version() . 'Product micro-service';
});


$router->group(['prefix' => 'product'], function () use ($router) {

    $router->get('/', [
        'as' => 'get.products',
        'uses' => 'ProductController@index'
    ]);

    $router->get('/{productId}', [
        'as' => 'get.product',
        'uses' => 'ProductController@show'
    ]);
});