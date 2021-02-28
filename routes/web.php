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
    return "Welcome to Fresh and Hot";
});

$router->group(['namespace' => 'Api'], function () use ($router) {
    $router->group(['prefix' => 'api'], function () use ($router)
    {
        $router->group(['middleware' => 'auth'], function ($router)
        {
            $router->get('me', 'AuthController@me');
            $router->post('logout', 'AuthController@logout');
            $router->post('upload_image', 'ProductsController@uploadImage');
        });

        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');

        $router->group(['prefix' => 'products'], function () use ($router) {
            $router->get('{id}/details', 'ProductsController@getProductById');
            $router->get('all', 'ProductsController@getAllProducts');

            $router->group(['middleware' => 'auth'], function ($router) {
                $router->post('sync', 'FrontpadController@synchronizeFrontpad');
                $router->put('{id}/update', 'ProductsController@updateProduct');
                $router->post('new', 'ProductsController@createProduct');
            });
        });

        $router->get('subcategories/all', 'SubCategoryController@getAllSubCategories');

        $router->group(['prefix' => 'categories'], function () use ($router) {
            $router->get('{id}/details', 'CategoryController@getCategoryById');
            $router->get('{category_id}/subcategories', 'SubCategoryController@getSubCategoriesById');
            $router->get('all', 'CategoryController@getAllCategories');
            $router->group(['middleware' => 'auth'], function ($router) {
                $router->post('new', 'CategoryController@createCategory');
                $router->put('{id}/update', 'CategoryController@updateCategory');
                $router->delete('{id}/delete', 'CategoryController@deleteCategory');
                $router->post('{category_id}/subcategories/new', 'SubCategoryController@createCategory');
            });
        });

    });



});
