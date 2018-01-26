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
    HelloWorldController::raakaaine();
});

$routes->get('/ravintokirja/raakaaine/1', function() {
    HelloWorldController::muokkaussivu();
});

$routes->get('/ravintokirja/ruoka/luoannos', function() {
    HelloWorldController::luoannos();
});

$routes->get('/ravintokirja/ruoka/1', function() {
    HelloWorldController::annoksenmuokkaus();
});


