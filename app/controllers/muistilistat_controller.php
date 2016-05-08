<?php

//require 'app/models/askare.php';
//require 'app/models/muistilista.php';

class MuistilistaController extends BaseController {


    public static function index() {
      self::check_logged_in();
        $muistilistat = Muistilista::all($_SESSION['user']);
        View::make('muistilista/index.html', array('muistilistat' => $muistilistat));
    }
    

    public static function create() {
      self::check_logged_in();
//      $kayttaja_id = self::get_user_logged_in()->kayttaja_id;
      $askareet = Askare::all($_SESSION['user']);
        View::make('muistilista/uusi.html', array('askareet' => $askareet));
    }

    public static function edit($id) {
      self::check_logged_in();
        $muistilista = Muistilista::find($id);
        $askareet = Askare::all($_SESSION['user']);
        View::make('muistilista/mlista_edit.html', array('muistilista' => $muistilista, 'askareet' => $askareet));
    }

    public static function update($id) {
      self::check_logged_in();
    
    $params = $_POST;
    
    if (!array_key_exists('askareet', $params)) {
    
    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'luomispaiva' => $params['luomispaiva'],
      'tarkeys' => $params['tarkeys'],
      'status' => $params['status'],
      'voimassaolopaiva' => $params['voimassaolopaiva'],
      'kuvaus' => $params['kuvaus']
    );
    
     } else {
            $askareet = $params['askareet'];
            $attributes = array(
                'id' => $id,
                'nimi' => $params['nimi'],
                'luomispaiva' => $params['luomispaiva'],
                'tarkeys' => $params['tarkeys'],
                'status' => $params['status'],
                'voimassaolopaiva' => $params['voimassaolopaiva'],
                'kuvaus' => $params['kuvaus'],
           //     Kint::dump($params);
           //     die("tuleeko tänne");
                'askareet' => array()
            );
            foreach ($askareet as $askare) {
                $attributes['askareet'][] = $askare;
            }
        }

    // Alustetaan Muistilista-olio käyttäjän syöttämillä tiedoilla
    $muistilista = new Muistilista($attributes);
    $errors = $muistilista->errors();

    if(count($errors) > 0) {
      View::make('muistilista/mlista_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    } else {
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
      $muistilista->update();

      Redirect::to('/muistilista/' . $muistilista->id, array('message' => 'Muistilistaa on muokattu onnistuneesti!'));
    }
  }

  // Muistilistan poistaminen
  public static function destroy($id) {
	  self::check_logged_in();
    // Alustetaan Muistilista-olio annetulla id:llä
    $muistilista = new Muistilista(array('id' => $id));
    // Kutsutaan Muistilista-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $muistilista->destroy();

    // Ohjataan käyttäjä muistilistojen listaussivulle ilmoituksen kera
    Redirect::to('/muistilista', array('message' => 'Muistilista on poistettu onnistuneesti!'));
  }

    public static function show($id) {
	  self::check_logged_in();
	  $muistilista = Muistilista::find($id);
    //    $muistilista = Muistilista::find($_SESSION['user']);
//        $askareet = Askare::hae_askareet($muistilista_id);
        View::make('muistilista/mlista_show.html', array('muistilista'=>$muistilista)); 
    }

    public static function store() {
      self::check_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Muistilista-luokan olion käyttäjän syöttämillä arvoilla
    if (!array_key_exists('askareet', $params)) {
    
    $attributes = array(
      'kayttaja_id' => $_SESSION['user'],
      'nimi' => $params['nimi'],
      'luomispaiva' => $params['luomispaiva'],
      'tarkeys' => $params['tarkeys'],
      'status' => $params['status'],
      'voimassaolopaiva' => $params['voimassaolopaiva'],
      'kuvaus' => $params['kuvaus']
    );
    
     } else {
            $askareet = $params['askareet'];
            $attributes = array(
                'kayttaja_id' => $_SESSION['user'],
                'nimi' => $params['nimi'],
                'luomispaiva' => $params['luomispaiva'],
                'tarkeys' => $params['tarkeys'],
                'status' => $params['status'],
                'voimassaolopaiva' => $params['voimassaolopaiva'],
                'kuvaus' => $params['kuvaus'],
                'askareet' => array()
            );
            foreach ($askareet as $askare) {
                $attributes['askareet'][] = $askare;
            }
        }
        
        $muistilista = new Muistilista($attributes);

        $errors = $muistilista->errors();

        if (count($errors) == 0) {
            
            $muistilista->save();
            
            Redirect::to('/muistilista/' . $muistilista->id, array('errors' => $errors, 'message' => 'Uusi muistilista on lisätty kirjastoosi!'));
         // Ohjataan käyttäjä lisäyksen jälkeen muistilistan esittelysivulle   
        } else {            
//            $errors_askareet = Askare::all($kayttaja_id);
            View::make('/muistilista/uusi.html', array('errors' => $errors, /*'askareet' => $errors_askareet,*/ 'attributes' => $attributes));
        }
    }

        
}
