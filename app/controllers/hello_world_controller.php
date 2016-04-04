<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function index(){
      View::make('suunnitelmat/index.html');
    }

    public static function askar_list(){
      View::make('suunnitelmat/askar_list.html');
    }

    public static function askar_show(){
      View::make('suunnitelmat/askar_show.html');
    }

    public static function askar_edit(){
    View::make('suunnitelmat/askar_list.html');
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

    public static function mlista_list(){
      View::make('suunnitelmat/mlista_list.html');
    }

    public static function mlista_edit(){
      View::make('suunnitelmat/mlista_edit.html');
    }

    public static function mlista_show(){
      View::make('suunnitelmat/mlista_show.html');
    }

  }
