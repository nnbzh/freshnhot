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
            $router->post('upload_image', 'ImageController@uploadImage');
            $router->post('delete_image', 'ImageController@deleteImage');
            $router->post('sliders/new', 'ImageController@addSlider');
            $router->post('promocodes/generate', "PromoCodeController@generatePromoCode");
            $router->get('promocodes/all', "PromoCodeController@getPromoCodes");
            $router->post('promocodes/new', "PromoCodeController@createPromoCode");
            $router->delete('promocodes/{id}/delete', "PromoCodeController@deletePromoCode");
            $router->post('new_order', 'FrontpadController@createNewOrder');
            $router->get('users', 'AuthController@users');
        });

        $router->get('sliders/all', 'ImageController@getSliders');
        $router->get('promocodes/{code}', 'PromoCodeController@getPromoCode');
        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');

        $router->group(['prefix' => 'products'], function () use ($router) {
            $router->get('{id}/details', 'ProductsController@getProductById');
            $router->get('all', 'ProductsController@getAllProducts');

            $router->group(['middleware' => 'auth'], function ($router) {
                $router->post('sync', 'FrontpadController@synchronizeFrontpad');
                $router->put('{id}/update', 'ProductsController@updateProduct');
                $router->post('new', 'ProductsController@createProduct');
                $router->post('update_stock', 'ProductsController@updateStock');
            });
        });

        $router->get('subcategories/all', 'SubCategoryController@getAllSubCategories');

        $router->group(['middleware' => 'auth'], function ($router) {
            $router->delete('subcategories/{sub_category_id}/delete', 'SubCategoryController@deleteSubcategory');
            $router->put('subcategories/{sub_category_id}/update', 'SubCategoryController@updateSubcategory');
        });


        $router->group(['prefix' => 'categories'], function () use ($router) {
            $router->get('{id}/details', 'CategoryController@getCategoryById');
            $router->get('{category_id}/subcategories', 'SubCategoryController@getSubCategoriesById');
            $router->get('all', 'CategoryController@getAllCategories');
            $router->group(['middleware' => 'auth'], function ($router) {
                $router->post('new', 'CategoryController@createCategory');
                $router->put('{id}/update', 'CategoryController@updateCategory');
                $router->delete('{id}/delete', 'CategoryController@deleteCategory');
                $router->post('{category_id}/subcategories/new', 'SubCategoryController@createSubcategory');
            });
        });

        $router->group(['prefix' => 'events'], function () use ($router) {
            $router->get('all', 'EventController@getAllEvents');
            $router->get('{id}/details', 'EventController@getEvent');

            $router->group(['middleware' => 'auth'], function ($router) {
                $router->post('new', 'EventController@addEvent');
                $router->delete('{id}/delete', 'EventController@deleteEvent');
                $router->put('{id}/update', 'EventController@updateEvent');

            });
        });

        $router->group(['prefix' => 'paragraphs'], function () use ($router) {
            $router->group(['middleware' => 'auth'], function ($router) {
                $router->post('new', 'EventController@addParagraph');
                $router->put('{id}/update', 'EventController@updateParagraph');
                $router->delete('{id}/delete', 'EventController@deleteParagraph');
            });
        });
    });
});
