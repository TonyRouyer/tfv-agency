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
 // relation avec la table user
    return $router->app->hasOne('App\User', 'id_tfv042119_user');
});

//  ROUTE REAL ESTATE
$router->group(['prefix' => ''], function () use ($router) {
    // 'realEstate' en POST créer un nouveau bien / champs obligatoire : 'referencePublishing', 'houseApartment' , 'saleOrRental' , 'title' , 'fullText', 'coverImage' , 'address', 'zip' , 'city' , 'complement', 'price' , 'area' , 'numberOfPieces' , 'digicode' , 'furniture' , 'balcony' , 'elevator' , 'garden' , 'garage', 'parking' ,'cellar', 'id_tfv042119_status', 'id_tfv042119_agency'
    // uses signifie "utilise"
    $router->post('realEstate', [
        'middleware' => 'roleResponsable',
        'uses' => 'realEstateController@createRealEstate'
    ]);
    // 'archiveRealEstate/{id}' en PUT place le bien au status archivé
    $router->post('archiveRealEstate/{id}', [
        'middleware' => 'roleResponsable',
        'uses' => 'realEstateController@deleteRealEstate'
    ]);
    // 'validateRealEstate/{id}' en PUT met à jour le status de l'annonce vers 1 = publié
    $router->post('realestateControllerValidate/{id}', [
        'middleware' => 'roleValidateur',
        'uses' => 'realEstateController@validateRealEstate'
    ]);
    // realEstate/{id} en GET récupère les infos du bien à l'article sélectionné
    $router->post('realEstate/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'realEstateController@showRealEstateDetail'
    ]);
    // 'updateRealEstate/{id}' en PUT met à jour le bien à l'id choisit
    $router->post('updateRealEstate/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'realEstateController@updateRealEstate'
    ]);
});
// ROUTE ACTUALITÉ
$router->group(['prefix' => ''], function () use ($router) {
    // 'new/{id}' en GET affiche l'article à l'id choisit
    $router->get('news/{id}', 'newsController@showNews');
    // 'allNewsPublished' en GET affiche la liste des articles publiés
    $router->get('allNewsPublished', 'newsController@showNewsListPublished');
    // 'news' en POST créer un nouvelle article / champs obligatoire : 'title', 'imageNews' , 'fullText' , 'datePublishing' , 'author' , 'id_tfv042119_status'
    // uses signifie "utilise"
    $router->post('news', [
        'middleware' => 'roleUsers',
        'uses' => 'newsController@createNews'
    ]);
    // 'updateNews/{id}' en PUT  modifie l'article à l'id choisit
    $router->put('updateNews/{id}', [
        'middleware' => 'roleResponsable',
        'uses' => 'newsController@updateNews'
    ]);
    // 'archiveNews/{id}' en PUT place l'article définit par l'id au status archivé
    $router->put('archiveNews/{id}', [
        'middleware' => 'roleResponsable',
        'uses' => 'newsController@deleteNews'
    ]);
    // 'allNewsArchive' en GET affiche la liste des article archivés
    $router->get('allNewsArchive', [
        'middleware' => 'roleResponsable',
        'uses' => 'newsController@showNewsListArchive'
    ]);
    //  validateNews en PUT valide l'article a l'id choisie
    $router->put('validateNews/{id}', [
        'middleware' => 'roleValidateur',
        'uses' => 'newsController@validateNews'
    ]);
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
// ROUTE HOUSE
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
// ROUTE APARTEMENT
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
    // ROUTE AGENCY
    // 'agency' en PUT créer une nouvelle agence dans la bdd / champs obligatoire : 'name' , 'address' , 'city' , 'zip'
    $router->put('agency', [
        'middleware' => 'roleResponsable',
        'uses' => 'agencyController@createRealEstate'
    ]);
  // ROUTE MANAGEMENTPROPOSAL
$router->group(['prefix' => ''], function () use ($router) {
  // 'managementProposal/{id}' en GET affiche la mise en gestion à l'id choisit
  $router->get('managementProposal/{id}', 'managementProposalController@showManagementProposal');
  // 'allManagementProposalPublished' en GET affiche la liste des mises en gestion publiée
  $router->get('allManagementProposalPublished', 'managementProposalController@showManagementProposalListPublished');
  // 'managementProposal' en POST créer un nouvelle mise en gestion du propriétaire / champs obligatoire : 'type', 'address' , 'zip' , 'city' , 'fullText' , 'id_tfv042119_user'
  $router->post('proposalManagement', [
      'middleware' => 'roleUsers',
      'uses' => 'managementProposalController@createManagementProposal'])
      ->where('owner', 1)
      ->get();
  // 'managementProposal' en POST créer un nouvelle mise en gestion du locataire / champs obligatoire : 'type', 'address' , 'zip' , 'city' , 'fullText' , 'id_tfv042119_user'
  $router->post('proposalManagement', [
    'middleware' => 'roleUsers',
    'uses' => 'managementProposalController@createManagementProposal'])
    ->where('rental', 1)
    ->get();
  // 'updateManagementProposal/{id}' en PUT  modifie la mise en gestion à l'id choisit
  $router->put('updateManagementProposal/{id}', [
      'middleware' => 'roleResponsable',
      'uses' => 'managementProposalController@updateManagementProposal'
  ]);
  // 'archiveManagementProposal/{id}' en PUT place la mise en gestion définit par l'id au user archivée
  $router->put('archiveManagementProposal/{id}', [
      'middleware' => 'roleResponsable',
      'uses' => 'managementProposalController@deleteManagementProposal'
  ]);
  // 'allManagementProposalArchive' en GET affiche la liste des mises en gestion archivée
  $router->get('allProposalManagementArchive', [
      'middleware' => 'roleResponsable',
      'uses' => 'managementProposalController@showManagementProposalListArchive'
  ]);
  //  validateManagementProposal en PUT valide la mise en gestion à l'id choisit
  $router->put('validateManagementProposal/{id}', [
      'middleware' => 'roleValidateur',
      'uses' => 'managementProposalController@validateManagementProposal'
  ]);
 
});



// ROUTE APPOINTEMENT

    $router->post('addappointement', [
        'middleware' => 'roleAgence',
        'uses' => 'appointementController@createAppointement'
    ]);
    $router->get('getappointement', [
        'middleware' => 'roleAgence',
        'uses' => 'appointementController@getAppointementList'
    ]);
    $router->get('getappointementdetail/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'appointementController@showAppointementDetail'
    ]);
    $router->delete('deleteappointementdetail/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'appointementController@deleteAppointement'
    ]);
    $router->put('updateappointementdetail/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'appointementController@updateAppointement'
    ]);
    
    
    





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


// route estimate
$router->group(['prefix' => ''], function () use ($router) {
  // 'estimate' en POST créer un nouvelle estimation / champs obligatoire : 'price', 'address' , 'zip' , 'city' , 'area' , 'id_tfv042119_user'
  $router->post('estimate', 'estimateControllerAuthCreate@createEstimate');
  // 'estimateList' en GET affiche la liste de l'estimation
  $router->get('estimateList', 'estimateController@estmateList');
  // 'estimateDelete' en PUT efface l'estimation
  $router->put('deleteEstimate/{id}', 'estimateController@deleteEstimate');
});