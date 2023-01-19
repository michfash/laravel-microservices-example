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
    return $router->app->version() . ' Api-gateway Service';
});

/*
* Product Controllers
* All route names are prefixed with 'product'.
*/
$router->group(['prefix' => 'product'], function () use ($router) {

    $router->get('/', [
        'as' => 'get.products',
        'uses' => 'ProductController@getAllProducts'
    ]);

    $router->get('/{productId}', [
        'as' => 'get.product',
        'uses' => 'ProductController@getProduct'
    ]);
});

/*
* Order Controllers
* All route names are prefixed with 'order'.
*/
$router->group(['prefix' => 'order'], function () use ($router) {

    $router->get('/', [
        'as' => 'get.orders',
        'uses' => 'OrderController@getAllOrders'
    ]);

    $router->get('/{orderId}', [
        'as' => 'get.order',
        'uses' => 'OrderController@getOrder'
    ]);
});

/*
* User Controllers
* All route names are prefixed with 'user'.
*/
$router->group(['prefix' => 'user'], function () use ($router) {

    $router->get('/', [
        'as' => 'get.users',
        'uses' => 'UserController@getAllUsers'
    ]);

    $router->get('/{userId}', [
        'as' => 'get.user',
        'uses' => 'UserController@getUser'
    ]);

    $router->get('/{userId}/orders', [
        'as' => 'get.user.orders',
        'uses' => 'UserController@getUserOrders'
    ]);
});