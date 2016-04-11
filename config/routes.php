<?php

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

  $routes->get('/', function() {
	MuistilistaController::index();
  });

  $routes->get('/muistilista', function() {
        MuistilistaController::index();
  });

  $routes->post('/muistilista', function() {
        MuistilistaController::store();
  });

  $routes->get('/muistilista/new', function() {
        MuistilistaController::create();
  });

  $routes->get('/muistilista/:id', function($id) {
        MuistilistaController::show($id);
  });

