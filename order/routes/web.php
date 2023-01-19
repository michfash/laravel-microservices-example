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
    return $router->app->version() . 'Order micro-service';
});


$router->group(['prefix' => 'order'], function () use ($router) {

    $router->get('/', [
        'as' => 'get.orders',
        'uses' => 'OrderController@index'
    ]);

    $router->get('/{orderId}', [
        'as' => 'get.order',
        'uses' => 'OrderController@show'
    ]);

    $router->get('/user/{userId}', [
        'as' => 'get.user.orders',
        'uses' => 'OrderController@showByUser'
    ]);

});