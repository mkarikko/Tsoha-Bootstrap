<?php

class Muistilista extends BaseModel{

  public $id, $kayttaja_id, $nimi, $tarkeys, $luomispaiva, $status, $voimassaolopaiva, $kuvaus;

  public function __construct($attributes){
    parent::__construct($attributes);
  }


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

    return $muistilistat;

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
