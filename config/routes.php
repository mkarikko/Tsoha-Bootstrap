<?php

  $routes->get('/', function() {
	MuistilistaController::index();
  });

  $routes->get('/muistilista', function() {
        MuistilistaController::index();
  });

  $routes->post('/muistilista', function() {
        MuistilistaController::store();
  });

  $routes->get('/muistilista/uusi', function() {
        MuistilistaController::create();
  });

 $routes->get('/muistilista/:id/muokkaa', function($id) {
    // Muistilistan muokkauslomake
        MuistilistaController::edit($id);
  });

  $routes->post('/muistilista/:id/muokkaa', function($id) {
        MuistilistaController::update($id);
  });


  $routes->get('/muistilista/:id', function($id) {
        MuistilistaController::show($id);
  });

 
  $routes->post('/muistilista/:id/destroy', function($id) {
        MuistilistaController::destroy($id);
  });
  
  $routes->get('/muistilista/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
  });

  $routes->post('/muistilista/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
  });

  $routes->post('/muistilista/logout', function(){
  UserController::logout();
  }); 

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

// --- ESIMERKIT ----

/*  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/mlista', function() {
    HelloWorldController::mlista_list();
  });

  $routes->get('/mlista/1', function() {
    HelloWorldController::mlista_show();
  });

  $routes->get('/mledit', function() {
    HelloWorldController::mlista_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/askare', function() {
    HelloWorldController::askare_list();
  });

  $routes->get('/askare/1', function() {
    HelloWorldController::askare_show();
  });

  $routes->get('/askare/aedit', function() {
    HelloWorldController::askare_edit();
  });
*/
