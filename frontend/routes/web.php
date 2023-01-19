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

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend', 'as' => 'frontend'], function () use ($router) {
    /*
     * Frontend Controllers
     * All route names are prefixed with 'frontend'.
     */

    $router->get('/', ['uses' => 'HomeController@index', 'as' => 'index']);

    /*
    * Order Controllers
    * All route names are prefixed with 'order'.
    */
    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->get('/', [
            'as' => 'orders',
            'uses' => 'OrderController@getAllOrders'
        ]);

        $router->get('/{orderId}', [
            'as' => 'get.order',
            'uses' => 'OrderController@getOrder'
        ]);
    });

    /*
    * Product Controllers
    * All route names are prefixed with 'product'.
    */
    $router->group(['prefix' => 'product'], function () use ($router) {

        $router->get('/', [
            'as' => 'products',
            'uses' => 'ProductController@getAllProducts'
        ]);

        $router->get('/{productId}', [
            'as' => 'get.product',
            'uses' => 'ProductController@getProduct'
        ]);
    });

    /*
    * User Controllers
    * All route names are prefixed with 'user'.
    */
    $router->group(['prefix' => 'user'], function () use ($router) {

        $router->get('/', [
            'as' => 'users',
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
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin'], function () use ($router) {
    // All route names are prefixed with 'admin'.
    $router->get('/', function () {
        return redirect('/admin/dashboard', 301);
    });

    $router->get('dashboard', ['uses' => 'DashboardController@dashboard', 'as' => 'dashboard']);
});

// $router->get('/', function () use ($router) {
//     return $router->app->version() . ' Frontend micro-service';
// });
