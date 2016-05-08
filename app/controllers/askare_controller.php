<?php

//require 'app/models/askare.php';
//require 'app/models/muistilista.php';

class AskareController extends BaseController {


    public static function index() {
      self::check_logged_in();
                $askareet = Askare::all();
                View::make('muistilista/askare/askare_list.html', array('askareet' => $askareet));
    }
    
    public static function create() {
      self::check_logged_in();
        View::make('muistilista/askare/askare_uusi.html');
    }
    
    public static function store() {
      self::check_logged_in();
      $params = $_POST;
     // $kayttaja_id = self::get_user_logged_in()->kayttaja_id;
      $attributes = array(
        'kayttaja_id' => $_SESSION['user'],
        'nimi' => $params['nimi'],
        'lisayspaiva' => $params['lisayspaiva'],
        'tarkeys' => $params['tarkeys'],
        'status' => $params['status'],
        'voimassaolopaiva' => $params['voimassaolopaiva'],
        'kuvaus' => $params['kuvaus']
        
      );
      
      $askare = new Askare($attributes);
      $errors = $askare->errors();
      if (count($errors) == 0) {
		  $askare -> save();
		  Redirect::to('/muistilista/askare/' . $askare->id, array('message' => 'Uusi askare on lisätty muistilistaasi!'));
	  } else {
         //   $errors_askareet = Askareet:all($kayttaja_id);
            View::make('/muistilista/askare/askare_uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }     
    }

    public static function edit($id) {
      self::check_logged_in();
        $askare = Askare::find($id);
        View::make('muistilista/askare/askare_edit.html', array('askare' => $askare));
    }

    public static function update($id) {
      self::check_logged_in();
    
    $params = $_POST;

    $attributes = array(
      'kayttaja_id' => $_SESSION['user'],
      'id' => $id,
      'nimi' => $params['nimi'],
      'lisayspaiva' => $params['lisayspaiva'],
      'tarkeys' => $params['tarkeys'],
      'status' => $params['status'],
      'voimassaolopaiva' => $params['voimassaolopaiva'],
      'kuvaus' => $params['kuvaus']
      
    );

    // Alustetaan Askare-olio käyttäjän syöttämillä tiedoilla
    $askare = new Askare($attributes);
    $errors = $askare->errors();

    if(count($errors) > 0) {
      View::make('muistilista/askare/askare_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    } else {
      // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
      $askare->update();

      Redirect::to('/muistilista/askare/' . $askare->id, array('message' => 'Askaretta on muokattu onnistuneesti!'));
    }
  }

  // Askareen poistaminen
  public static function destroy($id) {
	  self::check_logged_in();
    // Alustetaan Askare-olio annetulla id:llä
    $askare = new Askare(array('id' => $id));
    // Kutsutaan Askare-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $askare->destroy();

    // Ohjataan käyttäjä askareiden listaussivulle ilmoituksen kera
    Redirect::to('/muistilista/askare/askare_list', array('message' => 'Askare on poistettu onnistuneesti!'));
  }

    public static function show($id) {
	  self::check_logged_in();
        $askare = Askare::find($id);
        View::make('muistilista/askare/askare_show.html', array('askare'=>$askare)); 
    }
}

// TÄSTÄ ALASPÄIN TURHAA SÄÄTÖÄ

/*    public static function store() {
      self::check_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Askare-luokan olion käyttäjän syöttämillä arvoilla
        
        $attributes = array(
            'nimi' => $params['nimi'],
            'lisayspaiva' => $params['lisayspaiva'],
            'tarkeys' => $params['tarkeys'],
            'status' => $params['status'],
            'voimassaolopaiva' => $params['voimassaolopaiva'],
            'kuvaus' => $params['kuvaus']
        );

        $askare = new Askare($attributes);

        $errors = $askare->errors();

        if (count($errors) == 0) {
            
            $askare->save();

            Redirect::to('/muistilista/askare/askare_list' . $askare->id, array('message' => 'Uusi askare on lisätty muistilistaasi!'));
        } else {

            View::make('/muistilista/askare/askare_uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

        //Kint::dump($params);

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
 //       $askare->save();

        // Ohjataan käyttäjä lisäyksen jälkeen askareen esittelysivulle
        
    
} */ 
