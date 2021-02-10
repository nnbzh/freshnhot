<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return $router->app->version();
});

$router->group(['namespace' => 'Api'], function () use ($router) {
    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->get('{id}/details', [
            'as'    => 'product.details',
            'uses'  => 'ProductController@getProductById;'
        ]);
        $router->post('new', [
            "as"    => 'product.create',
            "uses"  => 'ProductsController@createProduct'
        ]);
        $router->get('all', [
           "as"     => 'product.all',
           "uses"   => 'ProductsController@getAllProducts'
        ]);
    });

    $router->group(['prefix' => 'category'], function () use ($router) {
        $router->get('{id}/details', [
            'as'    => 'product.details',
            'uses'  => 'CategoryController@getProductById;'
        ]);
        $router->post('new', [
            "as"    => 'product.create',
            "uses"  => 'CategoryController@createCategory'
        ]);
        $router->get('all', [
            "as"     => 'product.all',
            "uses"   => 'ProductsController@getAllProducts'
        ]);
    });

});
