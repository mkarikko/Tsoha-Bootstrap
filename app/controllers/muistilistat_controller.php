<?php

class MuistilistaController extends BaseController{


    public static function index(){
                $muistilistat = Muistilista::all();
                View::make('muistilista/index.html', array('muistilistat' => $muistilistat));
    }

    public function save(){
    	$query = DB::connnection()->prepare('INSERT INTO Muistilista (nimi, luotu, tarkeys, status, voimassaolopaiva, kuvaus) VALUES (:nimi, :luotu, :tarkeys, :status, :voimassaolopaiva, :kuvaus) RETURNING id');
    	$query->execute(array('nimi' => $this->nimi, 'luotu' => $this->luotu, 'tarkeys' => $this-> tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus));
    	$row = $query->fetch();
    	Kint::trace();
    	Kint::dump($row)

    	//$this->id = $row['id'];
    }

    public static function store(){
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Muistilista-luokan olion käyttäjän syöttämillä arvoilla
        $muistilista = new Muistilista(array(
            'nimi' => $params['nimi'],
            'luotu' => $params['luotu'],
            'tarkeys' => $params['tarkeys'],
            'status' => $params['status'],
            'voimassaolopaiva' => $params['voimassaolopaiva'],
            'kuvaus' => $params['kuvaus']
        ));

        Kint::dump($params);

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $muistilista->save();

        // Ohjataan käyttäjä lisäyksen jälkeen muistilistan esittelysivulle
        //Redirect::to('/muistilista/' . $muistilista->id, array('message' => 'Uusi muistilista on lisätty kirjastoosi!'));
     }
}