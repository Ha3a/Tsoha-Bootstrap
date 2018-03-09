<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/register', function() {
    UserController::createAccount();
});

$routes->post('/register', function() {
    UserController::store();
});


$routes->get('/ravintokirja/ruoka', function() {
    HelloWorldController::ruoka();
});




$routes->get('/ravintokirja/raakaaine', function() {
    RaakaaineController::index();
});

$routes->post('/ravintokirja/raakaaine', function() {
    RaakaaineController::store();
});

$routes->get('/ravintokirja/lisaaraakaaine', function() {
    RaakaaineController::lisayssivu();
});

$routes->post('/ravintokirja/lisaaraakaaine', function() {
    RaakaaineController::store();
});

$routes->get('/ravintokirja/raakaaine/:id', function($id) {
    RaakaaineController::show($id);
});

$routes->get('/ravintokirja/raakaaine/:id/edit', function($id) {
    RaakaaineController::edit($id);
});

$routes->post('/ravintokirja/raakaaine/:id/edit', function($id) {
    RaakaaineController::update($id);
});

$routes->post('/ravintokirja/raakaaine/:id/destroy', function($id) {
    RaakaaineController::destroy($id);
});

$routes->get('/ravintokirja/annos', function() {
    AnnosController::index();
});

$routes->post('/ravintokirja/annos', function() {
    AnnosController::store();
});

$routes->get('/ravintokirja/lisaaannos', function() {
    AnnosController::lisayssivu();
});

$routes->post('/ravintokirja/lisaaannos', function() {
    AnnosController::store();
});

$routes->get('/ravintokirja/annos/:id', function($id) {
    AnnosController::show($id);
});

$routes->get('/ravintokirja/annos/:id/edit', function($id) {
    AnnosController::edit($id);
});

$routes->post('/ravintokirja/annos/:id/edit', function($id) {
    AnnosController::update($id);
});

$routes->post('/ravintokirja/annos/:id/destroy', function($id) {
    AnnosController::destroy($id);
});




$routes->post('/ravintokirja/annos/:aid/lisaaraakaaine/:rid', function($aid, $rid) {
    AnnosController::lisaaAnnokseen($aid, $rid);
});


$routes->post('/ravintokirja/annos/:aid/update/:rid', function($aid, $rid) {
    AnnosController::updateSisalto($aid, $rid);
});


$routes->post('/ravintokirja/annos/:aid/destroy/:rid', function($aid, $rid) {
    AnnosController::destroyRaakaaine($aid, $rid);
});





$routes->get('/ravintokirja/ruokailut', function() {
    RuokailutController::index();
});


$routes->post('/ravintokirja/ruokailut/:aid/eat', function($aid) {
    RuokailutController::eat($aid);
});

//$routes->get('/ravintokirja/ruokailut/:aid/eat', function($aid) {
//    RuokailutController::eat($aid);
//});

$routes->post('/ravintokirja/ruokailut/:aid/destroy', function($aid) {
    RuokailutController::destroy($aid);
});







$routes->get('/login', function() {
    UserController::login();
});
$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});





//$routes->get('/ravintokirja/raakaaine/1', function() {
//    HelloWorldController::muokkaussivu();
//});

$routes->get('/ravintokirja/ruoka/luoannos', function() {
    HelloWorldController::luoannos();
});

$routes->get('/ravintokirja/ruoka/1', function() {
    HelloWorldController::annoksenmuokkaus();
});




