<?php


  class HelloWorldController extends BaseController{

//    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  echo 'Tämä on etusivu!';
//    }

    public static function sandbox(){
      // Testaa koodiasi täällä
//      View::make('helloworld.html');
      $yleislista = Muistilista::find(1);
      $muistilistat = Muistilista::all();
      Kint::dump($muistilistat);
      Kint::dump($yleislista);
      
    function validateDate($date, $format = 'd.m.Y'){
    $d = DateTime::createFromFormat($format, $date);
    if($d == FALSE){
	  echo 'Syötä päivämäärä muodossa pp.kk.vvvv!';
    }
    return $d && $d->format($format) == $date;
    
    
}
var_dump(validateDate('01.04.2016'));
var_dump(validateDate('1.4.2016'));
var_dump(validateDate('1.04.2016'));
    }

    public static function index(){
      View::make('suunnitelmat/index.html');
    }

    public static function askare_list(){
      View::make('suunnitelmat/askare_list.html');
    }

    public static function askare_show(){
      View::make('suunnitelmat/askare_show.html');
    }

    public static function askare_edit(){
    View::make('suunnitelmat/askare_list.html');
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
