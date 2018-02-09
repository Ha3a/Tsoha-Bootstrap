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





$routes->get('/login', function() {
    UserController::login();
});
$routes->post('/login', function() {
    UserController::handle_login();
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




