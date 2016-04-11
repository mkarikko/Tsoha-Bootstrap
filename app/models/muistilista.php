<?php

class Muistilista extends BaseModel{

  public $id, $kayttaja_id, $nimi, $tarkeys, $luomispaiva, $status, $voimassaolopaiva, $kuvaus;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public function save(){
      $query = DB::connection()->prepare('INSERT INTO Muistilista (nimi, luomispaiva, tarkeys, status, voimassaolopaiva, kuvaus) VALUES (:nimi, :luomispaiva, :tarkeys, :status, :voimassaolopaiva, :kuvaus) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'luomispaiva' => $this->luomispaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus));
      $row = $query->fetch();
      Kint::trace();
      Kint::dump($row);

      //$this->id = $row['id'];
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
