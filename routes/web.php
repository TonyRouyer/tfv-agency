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
    // 'updateRealEstate/{id}' en PUT met a jour le bien a l'id choisie
    $router->put('updateRealEstate/{id}', 'realEstateController@updateRealEstate');
    // 'validateRealEstate/{id}' en PUT met a jour le status de l'annonce vers 1 = publier
    $router->put('validateRealEstate/{id}', 'realEstateController@validateRealEstate');
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

<<<<<<< HEAD
// route cretion d'agence
    // 'agency' en PUT cree une nouvelle agence dans la bdd / champs obligatoire : 'name' , 'address' , 'city' , 'zip'
    $router->put('agency', 'agencyController@createRealEstate');
=======
// route appointment
$router->group(['prefix' => ''], function () use ($router) {
    // 'appointment' en POST créer un nouveau rendez-vous / champs obligatoire :  'dateTime', 'label', 'id_tfv042119_employee'
    $router->post('appointment', 'appointmentController@createAppointment');
    // 'archiveAppointment/{id}' en PUT  modifie le rendez-vous à l'id choisit
    $router->put('updateAppointment/{id}', 'appointmentController@updateAppointment');
    // 'validateAppointment/{id}' en PUT change le rendez-vous de l'employé à '1' = publié
    $router->put('validateAppointment/{id}', 'appointmentController@validateAppointment');
    // 'archiveAppointment/{id}' en PUT place le rendez-vous definit par l'id de l'employé archivé
    $router->put('archiveAppointment/{id}', 'appointmentController@deleteAppointment');
    // 'allAppointmentPublished/{id}' en GET affiche le rendez-vous à l'id choisit
    $router->get('appointment/{id}', 'appointmentController@showAppointment');
    // 'allAppointmentPublished' en GET affiche la liste des rendez-vous publiés
    $router->get('allAppointmentPublished', 'appointmentController@showAppointmentListPublished');
    // 'allAppointmentArchive' en GET affiche la liste des rendez-vous archivés
    $router->get('allAppointmentArchive', 'appointmentController@showAppointmentListArchive');
  });

  // route employee
  $router->group(['prefix' => ''], function () use ($router) {
  $router->post('employee', 'employeeController@createEmployee');
  $router->get('employee', 'employeeController@getEmployeeList');
  });

  // route managementProposal
$router->group(['prefix' => ''], function () use ($router) {
    // 'managementProposal' en POST créer une nouvelle mise en gestion / champs obligatoire :  'type', 'address', 'zip', 'city', 'fullText', 'id_tfv042119_employee'
    $router->post('managementProposal', 'managementProposalController@createManagementProposal');
    // 'archiveManagementProposal/{id}' en PUT  modifie la mise en gestion à l'id choisit
    $router->put('updateManagementProposal/{id}', 'managementProposalController@updateManagementProposal');
    // 'validateManagementProposal/{id}' en PUT change la mise en gestion de l'employé à '1' = publié
    $router->put('validateManagementProposal/{id}', 'managementProposalController@validateManagementProposal');
    // 'archiveManagementProposal/{id}' en PUT place la mise en gestion definit par l'id de l'employé archivé
    $router->put('archiveManagementProposal/{id}', 'managementProposalController@deleteManagementProposal');
    // 'allManagementProposalPublished/{id}' en GET affiche la mise en gestion à l'id choisit
    $router->get('managementProposal/{id}', 'managementProposalController@showManagementProposal');
    // 'allManagementProposalPublished' en GET affiche la liste des mises en gestion publiées
    $router->get('allManagementProposalPublished', 'managementProposalController@showManagementProposalListPublished');
    // 'allManagementProposalArchive' en GET affiche la liste des mises en gestion archivées
    $router->get('allmanagementProposalArchive', 'managementProposalController@showManagementProposalListArchive');
  });
>>>>>>> 0ccc7387cae4d30f1a407543ff43669dc8090fdb

// route news
$router->group(['prefix' => ''], function () use ($router) {
    // 'news' en POST cree un nouvelle article / champs obligatoire :  'title', 'imageNews' , 'fullText' , 'datePublishing' , 'author' , 'id_tfv042119_status'
    $router->post('news', 'newsController@createNews');
<<<<<<< HEAD
    // 'updateNews/{id}' en PUT  modifie l'article a l'id choisie 
=======

    // 'updateNews/{id}' en PUT  modifie l'article a l'id choisie

    // 'archiveNews/{id}' en PUT  modifie l'article a l'id choisie

>>>>>>> 0ccc7387cae4d30f1a407543ff43669dc8090fdb
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

<<<<<<< HEAD
=======
// route owner
$router->group(['prefix' => ''], function () use ($router) {
    // 'owner' en POST créer un nouveau propriétaire / champs obligatoire : 'OwnerLastname', 'OwnerFirstname', 'OwnerMail', 'OwnerPhone', 'civility', 'id_tfv042119_management_proposal'
    $router->post('owner', 'ownerController@createOwner');
    // 'archiveOwner/{id}' en PUT  modifie le propriétaire à l'id choisit
    $router->put('updateOwner/{id}', 'ownerController@updateOwner');
    // 'validateOwner/{id}' en PUT change le propriétaire de la mise en gestion à '1' = publiée
    $router->put('validateOwner/{id}', 'ownerController@validateOwner');
    // 'archiveOwner/{id}' en PUT place le propriétaire definit par l'id de la mise en gestion archivée
    $router->put('archiveOwner/{id}', 'ownerController@deleteOwner');
    // 'allOwnerPublished/{id}' en GET affiche le propriétaire à l'id choisit
    $router->get('owner/{id}', 'ownerController@showOwner');
    // 'allOwnerPublished' en GET affiche la liste des propriétaires publiés
    $router->get('allOwnerPublished', 'ownerController@showOwnerListPublished');
    // 'allOwnerArchive' en GET affiche la liste des propriétaires archivés
    $router->get('allOwnerArchive', 'ownerController@showOwnerListArchive');
  });
>>>>>>> 0ccc7387cae4d30f1a407543ff43669dc8090fdb

  // route employee
    $router->post('employee', 'employeeController@createEmployee');

    $router->get('employee', 'employeeController@getEmployeeList');



    // authentification
    $router->group(['prefix' => ''], function () use ($router) {
       // Matches "/api/register
       $router->post('register', 'AuthController@register');

       $router->post('login', 'AuthController@login');

       $router->get('profile', 'UserController@profile');

       $router->get('users/{id}', 'UserController@singleUser');

       $router->get('users', 'UserController@allUsers');

       $router->put('update/{id}', 'UserController@UpdateUsers');


    });
