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
  // route création d'agence
  // 'agency' en PUT créer une nouvelle agence dans la bdd / champs obligatoire : 'name' , 'address' , 'city' , 'zip'
  $router->put('agency', 'agencyController@createRealEstate');

  // route apartement
  $router->group(['prefix' => ''], function () use ($router) {
  // 'saleApartment'  en GET récupère la liste des appartements en vente sans filtre
  $router->get('saleApartment', 'apartmentController@getApartmentSaleList');
  // 'rentalApartment' en GET récupère la liste des appartements en location sans filtre
  $router->get('rentalApartment', 'apartmentController@getApartmentRentalList');
  // 'apartmentSaleFilter/{search}' en GET récupère la liste des appartements en vente avec des filtres
  $router->get('apartmentSaleFilter/{search}', 'apartmentController@getApartmentSaleFilter');
  // 'apartmentRentalFilter/{search}' en GET récupère la liste des appartements en vente avec des filtres
  $router->get('apartmentRentalFilter/{search}', 'apartmentController@getApartmentRentalFilter');
});

  // route real estate
  $router->group(['prefix' => ''], function () use ($router) {
  // 'realEstate' en POST créer un nouveau bien / champs obligatoire : 'referencePublishing', 'houseApartment' , 'saleOrRental' , 'title' , 'fullText', 'coverImage' , 'address', 'zip' , 'city' , 'complement', 'price' , 'area' , 'numberOfPieces' , 'digicode' , 'furniture' , 'balcony' , 'elevator' , 'garden' , 'garage', 'parking' ,'cellar', 'id_tfv042119_status', 'id_tfv042119_agency'
  $router->post('realEstate', 'realEstateController@createRealEstate');
  // 'validateRealEstate/{id}' en PUT met à jour le status de l'annonce vers 1 = publié
  $router->put('realestateControllerValidate/{id}', 'realestateControllerValidate@validateRealEstate');
  // 'archiveRealEstate/{id}' en PUT place le bien au status archivé
  $router->put('archiveRealEstate/{id}', 'realEstateController@deleteRealEstate');
  // realEstate/{id} en GET récupère les infos du bien à l'article sélectionné
  $router->get('realEstate/{id}', 'realestateControllerShowDetail@showRealEstateDetail');


  // 'updateRealEstate/{id}' en PUT met à jour le bien à l'id choisit
  $router->put('updateRealEstate/{id}', 'realestateControllerShowDetail@updateRealEstate');
  });

  // route house
  $router->group(['prefix' => ''], function () use ($router) {
  // 'saleHouse' en GET récupère la liste des maisons en vente
  $router->get('saleHouse', 'houseController@getHouseSaleList');
  // 'rentalHouse' en GET récupère la liste des maisons en location
  $router->get('rentalHouse', 'houseController@getHouseRentalList');
  // 'houseSaleFilter/{search}' en GET récupère la liste des maisons en vente avec des filtres
  $router->get('houseSaleFilter/{search}', 'houseController@getHouseSaleFilter');
  // 'houseRentalFilter/{search}' en GET récupère la liste des maisons en location avec des filtres
  $router->get('houseRentalFilter/{search}', 'houseController@getHouseRentalFilter');
  });

// route estimate
$router->group(['prefix' => ''], function () use ($router) {

  // 'estimate' en POST créer un nouvelle estimation / champs obligatoire : 'price', 'address' , 'zip' , 'city' , 'area' , 'id_tfv042119_user'
  $router->post('estimate', 'estimateControllerAuthCreate@createEstimate');
  // 'estimateList' en GET affiche la liste de l'estimation
  $router->get('estimateList', 'estimateController@estmateList');
  // 'estimateDelete' en PUT efface l'estimation
  $router->put('deleteEstimate/{id}', 'estimateController@deleteEstimate');

  });

// route managementProposal
$router->group(['prefix' => ''], function () use ($router) {

  // 'managementProposal' en POST créer un nouvelle mise en gestion / champs obligatoire : 'type', 'address' , 'fullText' , 'zip' , 'city' , 'fullText', 'id_tfv042119_user'
  $router->post('managementProposal', 'managementProposalControllerAuthCreate@createManagementProposal');
  // 'updateManagementProposal/{id}' en PUT  modifie la mise en gestion à l'id choisit
  $router->put('updateManagementProposal/{id}', 'managementProposalControllerAuth@updateManagementProposal');
  // 'archiveManagementProposal/{id}' en PUT place la mise en gestion définit par l'id au user archivé
  $router->put('archiveManagementProposal/{id}', 'managementProposalControllerAuth@deleteManagementProposal');
  // 'allManagementProposalArchive' en GET affiche la liste des mises en gestion archivées
  $router->get('allManagementProposalArchive', 'managementProposalControllerAuth@showManagementProposalListArchive');
  // 'validateManagementProposal/{id}' en PUT change le user de la mise en gestion à '1' = publié
  $router->put('validateManagementProposal/{id}', 'managementProposalControllerAuthValidate@validateManagementProposal');
  // 'allManagementProposalPublished/{id}' en GET affiche la mise en gestion à l'id choisit
  $router->get('managementProposal/{id}', 'managementProposalController@showManagementProposal');
  // 'allManagementProposalPublished' en GET affiche la liste des mises en gestion publiées
  $router->get('allManagementProposalPublished', 'managementProposalController@showManagementProposalListPublished');
  });

  // route news
  $router->group(['prefix' => ''], function () use ($router) {

  // 'news' en POST créer un nouvelle article / champs obligatoire : 'title', 'imageNews' , 'fullText' , 'datePublishing' , 'author' , 'id_tfv042119_status'
  $router->post('news', 'newsControllerAuthCreate@createNews');
  // 'updateNews/{id}' en PUT  modifie l'article à l'id choisit
  $router->put('updateNews/{id}', 'newsControllerAuth@updateNews');
  // 'archiveNews/{id}' en PUT place l'article définit par l'id au status archivé
  $router->put('archiveNews/{id}', 'newsControllerAuth@deleteNews');
  // 'allNewsArchive' en GET affiche la liste des article archivés
  $router->get('allNewsArchive', 'newsControllerAuth@showNewsListArchive');
  // 'validateNews/{id}' en PUT change le status de l'article à '1' = publié
  $router->put('validateNews/{id}', 'newsControllerAuthValidate@validateNews');
  // 'allNewsPublished/{id}' en GET affiche l'article à l'id choisit
  $router->get('news/{id}', 'newsController@showNews');
  // 'allNewsPublished' en GET affiche la liste des articles publiés
  $router->get('allNewsPublished', 'newsController@showNewsListPublished');
  });



  //ROUTE SIMPLE UTILISATEUR

  $router->group(['prefix' => ''], function () use ($router) {

  $router->post('register', 'AuthController@register');

  $router->post('login', 'AuthController@login');

  $router->get('profile', [
  'middleware' => 'auth',
  'uses' => 'UserController@profile'
    ]);
  $router->put('update', [
  'middleware' => 'auth',
  'uses' => 'UserController@UpdateUsers'
    ]);
});

//ROUTE ADMIN
  $router->group(['prefix' => 'adm'], function () use ($router) {

    $router->post('register', [
    'middleware' => 'roleUsers',
    'uses' => 'UserController@registerEmployee'
      ]);
    $router->get('users', [
    'middleware' => 'roleUsers',
    'uses' => 'UserController@allUsers'
      ]);
    $router->get('users/{id}', [
    'middleware' => 'roleUsers',
    'uses' => 'UserController@singleUser'
      ]);
  });
