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
  
  $routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
  });

  $routes->post('/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
  });

  $routes->post('/logout', function(){
  UserController::logout();
  }); 

  $routes->get('/muistilista/askare', function() {
        AskareController::index();
  });

  $routes->post('/muistilista/askare', function() {
        AskareController::store();
  });

  $routes->get('/muistilista/askare/uusi', function() {
        AskareController::create();
  });

 $routes->get('/muistilista/askare/:id/muokkaa', function($id) {
    // Askareen muokkauslomake
        AskareController::edit($id);
  });

  $routes->post('/muistilista/askare/:id/muokkaa', function($id) {
        AskareController::update($id);
  });


  $routes->get('/muistilista/askare/:id', function($id) {
        AskareController::show($id);
  });

 
  $routes->post('/muistilista/askare/:id/destroy', function($id) {
        AskareController::destroy($id);
  });

// --- ESIMERKIT ----
/*
  $routes->get('/', function() {
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
//*/
