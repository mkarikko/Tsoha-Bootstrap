<?php

class MuistilistaController extends BaseController {


    public static function index() {
//      self::check_logged_in();
                $muistilistat = Muistilista::all();
                View::make('muistilista/index.html', array('muistilistat' => $muistilistat));
    }

    public static function create() {
//      self::check_logged_in();
        View::make('muistilista/uusi.html');
    }

    public static function edit($id) {
//      self::check_logged_in();
        $muistilista = Muistilista::find($id);
        View::make('muistilista/mlista_edit.html', array('muistilista' => $muistilista));
    }

    public static function update($id) {
//      self::check_logged_in();
    
    $params = $_POST;
//    Kint::dump($params);
//    die("tuleeko tänne");
    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'luomispaiva' => $params['luomispaiva'],
      'tarkeys' => $params['tarkeys'],
      'status' => $params['status'],
      'voimassaolopaiva' => $params['voimassaolopaiva'],
      'kuvaus' => $params['kuvaus']
    );

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
//	  self::check_logged_in();
    // Alustetaan Muistilista-olio annetulla id:llä
    $muistilista = new Muistilista(array('id' => $id));
    // Kutsutaan Muistilista-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $muistilista->destroy();

    // Ohjataan käyttäjä muistilistojen listaussivulle ilmoituksen kera
    Redirect::to('/muistilista', array('message' => 'Muistilista on poistettu onnistuneesti!'));
  }

    public static function show($id) {
//	  self::check_logged_in();
        $muistilista = Muistilista::find($id);
        View::make('muistilista/mlista_show.html', array('muistilista'=>$muistilista)); 
    }

    public static function store() {
//      self::check_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Muistilista-luokan olion käyttäjän syöttämillä arvoilla
        
        $attributes = array(
            'nimi' => $params['nimi'],
            'luomispaiva' => $params['luomispaiva'],
            'tarkeys' => $params['tarkeys'],
            'status' => $params['status'],
            'voimassaolopaiva' => $params['voimassaolopaiva'],
            'kuvaus' => $params['kuvaus']
        );

        $muistilista = new Muistilista($attributes);

        $errors = $muistilista->errors();

        if (count($errors) == 0) {
            
            $muistilista->save();

            Redirect::to('/muistilista/' . $muistilista->id, array('message' => 'Uusi muistilista on lisätty kirjastoosi!'));
        } else {

            View::make('/muistilista/uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

        //Kint::dump($params);

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
 //       $muistilista->save();

        // Ohjataan käyttäjä lisäyksen jälkeen muistilistan esittelysivulle
        
    
}
