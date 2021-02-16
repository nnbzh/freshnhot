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
    $router->group(['middleware' => 'auth','prefix' => 'api'], function ($router)
    {
        $router->get('me', 'AuthController@me');
        $router->post('logout', 'AuthController@logout');
    });

    $router->group(['prefix' => 'api'], function () use ($router)
    {
        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');
        $router->post('frontpad_test', 'FrontpadController@getProducts');

        $router->group(['prefix' => 'product'], function () use ($router) {
            $router->get('{id}/details', 'ProductController@getProductById');
            $router->post('new', 'ProductsController@createProduct');
            $router->get('all', 'ProductsController@getAllProducts');
        });

        $router->group(['prefix' => 'category'], function () use ($router) {
            $router->get('{id}/details', 'CategoryController@getProductById');
            $router->post('new', 'CategoryController@createCategory');
            $router->get('all', 'ProductsController@getAllProducts');
        });

    });



});
