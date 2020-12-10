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
    // return $router->app->version();
    return $router->app/Models/version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->get('authors',  ['uses' => 'AuthorController@showAllAuthors']);

  $router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);

  $router->post('authors', ['uses' => 'AuthorController@create']);

  $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);

  $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('realestate',  ['uses' => 'real_estateController@showAllRealEstate']);
  
    $router->get('realestate/{id}', ['uses' => 'real_estateController@showOneRealEstate']);
  
    $router->post('realestate', ['uses' => 'real_estateController@createRealEstate']);
  
    $router->delete('realestate/{id}', ['uses' => 'real_estateController@deleteRealEstate']);
  
    $router->put('realestate/{id}', ['uses' => 'real_estateController@updateRealEstate']);
  });