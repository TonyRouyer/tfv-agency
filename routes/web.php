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
    $router->get('/', function () use ($router) {
        return phpinfo();
    });
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
    $router->put('archiveRealEstate/{id}', [
        'middleware' => 'roleResponsable',
        'uses' => 'realEstateController@deleteRealEstate'
    ]);
    // 'validateRealEstate/{id}' en PUT met à jour le status de l'annonce vers 1 = publié
    $router->put('realestateControllerValidate/{id}', [
        'middleware' => 'roleValidateur',
        'uses' => 'realEstateController@validateRealEstate'
    ]);
    // realEstate/{id} en GET récupère les infos du bien à l'article sélectionné
    $router->get('realEstate/{id}', [
        'uses' => 'realEstateController@showRealEstateDetail'
    ]);
    // 'updateRealEstate/{id}' en PUT met à jour le bien à l'id choisit
    $router->put('updateRealEstate/{id}', [
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
        'middleware' => 'roleAgence',
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
        $router->get('managementProposal/{id}', [
            'middleware' => 'auth',
            'uses' => 'managementProposalController@showManagementProposalDetail'
        ]);
        // 'getManagementProposalList' en GET affiche la liste des mises en gestion publiée
    $router->get('getManagementProposalList', 'managementProposalController@getManagementProposalList');
    // 'managementProposal' en POST créer un nouvelle mise en gestion du propriétaire / champs obligatoire : 'type', 'address' , 'zip' , 'city' , 'fullText' , 'id_tfv042119_user'
    $router->post('proposalManagement', [
        'middleware' => 'roleUsers',
        'uses' => 'managementProposalController@createManagementProposal']);
    // 'updateManagementProposal/{id}' en PUT  modifie la mise en gestion à l'id choisit
    $router->put('updateManagementProposal/{id}', [
        'middleware' => 'roleResponsable',
        'uses' => 'managementProposalController@updateManagementProposal'
    ]);
});
// ROUTE APPOINTEMENT
$router->group(['prefix' => ''], function () use ($router) {
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
});
// ROUTE CLIENT LIST
$router->group(['prefix' => ''], function () use ($router) {
    $router->put('addclientlist', [
        'middleware' => 'roleAgence',
        'uses' => 'clientListController@createClientList'
    ]);
});
//ROUTE SALE OR RENTAL REQUEST
$router->group(['prefix' => ''], function () use ($router) {
    $router->post('addRequest', [
        'uses' => 'saleOrRental_requestController@addRequest'
    ]);
    $router->delete('deleteRequest/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'saleOrRental_requestController@deleteRequest'
    ]);
    $router->put('archiveRequest/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'saleOrRental_requestController@archiveRequest'
    ]);
    $router->get('showRequest/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'saleOrRental_requestController@showRequest'
    ]);
});
// ROUTE CLIENT LIST
$router->group(['prefix' => ''], function () use ($router) {
    $router->put('addclientlist', [
        'middleware' => 'roleAgence',
        'uses' => 'clientListController@createClientList'
    ]);
    $router->put('deleteClientList/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'clientListController@deleteClientList'
    ]);
    $router->get('getClientListDetail/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'clientListController@getClientListDetail'
    ]);
    $router->get('getClientListEmployee', [
        'middleware' => 'roleAgence',
        'uses' => 'clientListController@getClientListEmployee'
    ]);
});
// ROUTE CALL
$router->group(['prefix' => ''], function () use ($router) {
    $router->put('addcall', [
        'uses' => 'callController@addCall'
    ]);
    $router->delete('deletecall/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'callController@deleteCall'
    ]);
    $router->get('getCallDetail/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'callController@showOnecall'
    ]);
    $router->get('getAllCall', [
        'middleware' => 'roleAgence',
        'uses' => 'callController@showAllCall'
    ]);
});
// ROUTE FAVORITE
$router->group(['prefix' => ''], function () use ($router) {
    $router->put('addFavorite/{id}', [
        'middleware' => 'auth',
        'uses' => 'favoriteController@addFavorite'
    ]);
    $router->delete('deleteFavorite/{id}', [
        'middleware' => 'auth',
        'uses' => 'favoriteController@deleteFavorite'
    ]);
    $router->get('getFavorieList', [
        'middleware' => 'auth',
        'uses' => 'favoriteController@getFavorieList'
    ]);

});
// ROUTE ALERT
$router->group(['prefix' => ''], function () use ($router) {
    $router->put('addAlert', [
        'middleware' => 'auth',
        'uses' => 'alertController@addAlert'
    ]);
    $router->delete('deleteAlert/{id}', [
        'middleware' => 'auth',
        'uses' => 'alertController@deleteAlert'
    ]);
    $router->get('showAllAlert', [
        'middleware' => 'auth',
        'uses' => 'alertController@showAllAlert'
    ]);
});
// ROUTE MANAGEMENT PROPOSAL
$router->group(['prefix' => ''], function () use ($router) {
    $router->post('creatMP', [
        'middleware' => 'RoleGetionnaireLocatif',
        'uses' => 'managementProposalController@createManagementProposal'
    ]);
    $router->put('updateManagementProposal/{id}', [
        'middleware' => 'RoleGetionnaireLocatif',
        'uses' => 'managementProposalController@updateManagementProposal'
    ]);
    $router->get('showManagementProposalDetail/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'managementProposalController@showManagementProposalDetail'
    ]);
    $router->get('getManagementProposalList', [
        'middleware' => 'roleAgence',
        'uses' => 'managementProposalController@getManagementProposalList'
    ]);
});
// ROUTE FILES
$router->group(['prefix' => ''], function () use ($router) {
    $router->post('uploadImage', [
        'middleware' => 'roleAgence',
        'uses' => 'filesController@uploadImage'
    ]);
    $router->get('getFiles/{id}', [
        'middleware' => 'roleAgence',
        'uses' => 'filesController@getFiles'
    ]);
});
// ROUTE IMAGES
$router->group(['prefix' => ''], function () use ($router) {
    $router->post('uploadrealestateImg', [
        'middleware' => 'roleAgence',
        'uses' => 'imagesController@uploadrealestateImg'
    ]);
    $router->get('getRealestateImg/{id}', [
        'uses' => 'imagesController@getRealestateImg'
    ]);
});
// ROUTE ESTIMATE
$router->group(['prefix' => ''], function () use ($router) {
  // 'estimate' en POST créer un nouvelle estimation / champs obligatoire : 'price', 'address' , 'zip' , 'city' , 'area' , 'id_tfv042119_user'
  $router->post('estimate', 'estimateController@createEstimate');
//   // 'estimateList' en GET affiche la liste de l'estimation
//   $router->get('estimateList', 'estimateController@estmateList');
//   // 'estimateDelete' en PUT efface l'estimation
//   $router->put('deleteEstimate/{id}', 'estimateController@deleteEstimate');
});