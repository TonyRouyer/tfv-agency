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

// route real estate 
$router->group(['prefix' => ''], function () use ($router) {
    // 'realEstate' en POST cree un nouveau bien / champs obligatoire : 'referencePublishing', 'houseApartment' , 'saleOrRental' , 'title' , 'fullText', 'coverImage' , 'address', 'zip' , 'city' , 'complement', 'price' , 'area' , 'numberOfPieces' , 'digicode' , 'furniture' , 'balcony' , 'elevator' , 'garden' , 'garage', 'parking' ,'cellar', 'id_tfv042119_status', 'id_tfv042119_agency'
    $router->post('realEstate', 'realEstateController@createRealEstate');
    // 'realEstate/{id}' en PUT met a jour le bien a l'id choisie
    $router->put('realEstate/{id}', 'realEstateController@updateRealEstate');
    // 'archiveRealEstate/{id}' en PUT place le bien au status archivé
    $router->put('archiveRealEstate/{id}', 'realEstateController@deleteRealEstate');
    // realEstate/{id} en GET recupere les infos du bien a l'article selectionné
    $router->get('realEstate/{id}', 'realEstateController@showRealEstateDetail');
  });

// route house
$router->group(['prefix' => ''], function () use ($router) {
    // 'saleHouse' en GET recupere la liste des maison en vente
    $router->get('saleHouse', 'houseController@getHouseSaleList');
    // 'rentalHouse' en GET recupere la liste des maison en location
    $router->get('rentalHouse', 'houseController@getHouseRentalList');
    // 'houseSaleFilter/{search}' en GET recupere la liste des maison en vente avec des filtre
    $router->get('houseSaleFilter/{search}', 'houseController@getHouseSaleFilter');
    // 'houseRentalFilter/{search}' en GET recupere la liste des maison en location avec des filtre
    $router->get('houseRentalFilter/{search}', 'houseController@getHouseRentalFilter');
});

// route apartement 
$router->group(['prefix' => ''], function () use ($router) {
    // 'saleApartment'  en GET recupere la liste des appartement en vente sans filtre
    $router->get('saleApartment', 'apartmentController@getApartmentSaleList');
    // 'rentalApartment' en GET recupere la liste des appartement en location sans filtre
    $router->get('rentalApartment', 'apartmentController@getApartmentRentalList');
    // 'apartmentSaleFilter/{search}' en GET recupere la liste des appartement en vente avec des filtre
    $router->get('apartmentSaleFilter/{search}', 'apartmentController@getApartmentSaleFilter');
    // 'apartmentRentalFilter/{search}' en GET recupere la liste des appartement en vente avec des filtre
    $router->get('apartmentRentalFilter/{search}', 'apartmentController@getApartmentRentalFilter');
});

// route cretion d'agence
    // 'agency' en PUT cree une nouvelle agence dans la bdd / champs obligatoire : 'name' , 'address' , 'city' , 'zip'
    $router->put('agency', 'agencyController@createRealEstate');

// route news
$router->group(['prefix' => ''], function () use ($router) {
    // 'news' en POST cree un nouvelle article / champs obligatoire :  'title', 'imageNews' , 'fullText' , 'datePublishing' , 'author' , 'id_tfv042119_status'
    $router->post('news', 'newsController@createNews');
    // 'archiveNews/{id}' en PUT  modifie l'article a l'id choisie 
    $router->put('updateNews/{id}', 'newsController@updateNews');
    // 'validateNews/{id}' en PUT change le statue de l'article a '1' = publié
    $router->put('validateNews/{id}', 'newsController@validateNews');
    // 'archiveNews/{id}' en PUT place l'article definie par l'id au statue archivé
    $router->put('archiveNews/{id}', 'newsController@deleteNews');
    // 'allNewsPublished/{id}' en GET affiche l'article a l'id choisie
    $router->get('news/{id}', 'newsController@showNews');
    // 'allNewsPublished' en GET affiche la liste des article publiés
    $router->get('allNewsPublished', 'newsController@showNewsListPublished');
    // 'allNewsArchive' en GET affiche la liste des article archivés
    $router->get('allNewsArchive', 'newsController@showNewsListArchive');
  });