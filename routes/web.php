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




// route real estate A MODIFIER
$router->group(['prefix' => ''], function () use ($router) {
    $router->post('realestate', 'realestateController@createRealEstate');
    // $router->delete('realestate/{id}', 'realestateController@deleteRealEstate');
    // $router->put('realestate/{id}', 'realestateController@updateRealEstate');
  });




// route house
$router->group(['prefix' => ''], function () use ($router) {
    $router->get('saleHouse', 'houseController@getHouseSaleList');
    $router->get('rentalHouse', 'houseController@getHouseRentalList');

    $router->get('houseSaleFilter/{search}', 'houseController@getHouseSaleFilter');
    $router->get('houseRentalFilter/{search}', 'houseController@getHouseRentalFilter');
});
// route apartement 
$router->group(['prefix' => ''], function () use ($router) {
    $router->get('saleApartment', 'apartmentController@getApartmentSaleList');
    $router->get('rentalApartment', 'apartmentController@getApartmentRentalList');

    $router->get('apartmentSaleFilter/{search}', 'apartmentController@getApartmentSaleFilter');
    $router->get('apartmentRentalFilter/{search}', 'apartmentController@getApartmentRentalFilter');

});
// route cretion d'agence
$router->put('agency', 'agencyController@createRealEstate');






    