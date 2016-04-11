<?php

class MuistilistaController extends BaseController{


    public static function index(){
                $muistilistat = Muistilista::all();
                View::make('muistilista/index.html', array('muistilistat' => $muistilistat));
    }

    public static function create(){
        View::make('muistilista/uusi.html');
    }

    public static function show(){
        View::make('muistilista/mlista_show.html');
        $muistilista->find($id);
    }

    public static function store(){
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Muistilista-luokan olion käyttäjän syöttämillä arvoilla
        $muistilista = new Muistilista(array(
            'nimi' => $params['nimi'],
            'luomispaiva' => $params['luomispaiva'],
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