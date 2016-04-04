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

  $routes->get('/askar', function() {
    HelloWorldController::askar_list();
  });

  $routes->get('/askar/1', function() {
    HelloWorldController::askar_show();
  });

  $routes->get('/askar/aedit', function() {
    HelloWorldController::askar_edit();
  });

