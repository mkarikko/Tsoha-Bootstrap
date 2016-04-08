<?php

class Muistilista extends BaseModel{

  public $id, $kayttaja_id, $nimi, $tarkeys, $luomispaiva, $status, $voimassaolopaiva, $kuvaus;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  $yleislista = new Muistilista(array('id' => 1, 'nimi' => 'Yleismuistilista', 'tarkeys' => '4', 'luomispaiva'=> '2011-11-11', 'status' =>'kesken', 'voimassaolopaiva' => '2050-12-31', 'kuvaus' => 'Yleismuistilista jokapäiväisille askareille.'));

  echo $yleislista->nimi;

  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Muistilista');
    $query->execute();
    $rows = $query->fetchAll();
    $muistilistat = array();

    foreach($rows as $row){
      $muistilistat[] = new Muistilista(array(
        'id' => $row['id'],
        'kayttaja_id' => $row['kayttaja_id'],
        'nimi' => $row['nimi'],
        'tarkeys' => $row['tarkeys'],
        'luomispaiva' => $row['luomispaiva'],
        'status' => $row['status'],
        'voimassaolopaiva' => $row['voimassaolopaiva'],
        'kuvaus' => $row['kuvaus']
      ));
    }

    return $muistilistat

  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Muistilista WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $muistilista = new Muistilista(array(
        'id' => $row['id'],
        'kayttaja_id' => $row['kayttaja_id'],
        'nimi' => $row['nimi'],
        'tarkeys' => $row['tarkeys'],
        'luomispaiva' => $row['luomispaiva'],
        'status' => $row['status'],
        'voimassaolopaiva' => $row['voimassaolopaiva'],
        'kuvaus' => $row['kuvaus']
      ));

      return $muistilista;
    } 

    return null;
  }
}
