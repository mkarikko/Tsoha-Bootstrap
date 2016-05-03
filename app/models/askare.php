<?php

class Askare extends BaseModel {

  public $id, $kayttaja_id, $muistilista_id, $nimi, $tarkeys, $lisayspaiva, $status, $voimassaolopaiva, $kuvaus;

  public function __construct($attributes) {
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_lisayspaiva', 'validate_voimassaolopaiva');
  }

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Askare (nimi, lisayspaiva, tarkeys, status, voimassaolopaiva, kuvaus) VALUES (:nimi, :lisayspaiva, :tarkeys, :status, :voimassaolopaiva, :kuvaus) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'lisayspaiva' => $this->lisayspaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus));
      $row = $query->fetch();
//Kint::trace();
//Kint::dump($row);

      $this->id = $row['id'];
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT * FROM Askare');
    $query->execute();
    $rows = $query->fetchAll();
    $askareet = array();

    foreach($rows as $row) {
      $askareet[] = new Askare(array(
        'id' => $row['id'],
        'kayttaja_id' => $row['kayttaja_id'],
        'muistilista_id' => $row['muistilista_id'],
        'nimi' => $row['nimi'],
        'tarkeys' => $row['tarkeys'],
        'lisayspaiva' => $row['lisayspaiva'],
        'status' => $row['status'],
        'voimassaolopaiva' => $row['voimassaolopaiva'],
        'kuvaus' => $row['kuvaus']
      ));
    }

    return $askareet;

  } 

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id LIMIT 1');
    $query->execute(array('id' => (int)$id));
    $row = $query->fetch();

    if($row) {
      $askare = new Askare(array(
        'id' => $row['id'],
        'kayttaja_id' => $row['kayttaja_id'],
        'muistilista_id' => $row['muistilista_id'],
        'nimi' => $row['nimi'],
        'lisayspaiva' => $row['lisayspaiva'],
        'tarkeys' => $row['tarkeys'],
        'status' => $row['status'],
        'voimassaolopaiva' => $row['voimassaolopaiva'],
        'kuvaus' => $row['kuvaus']
      ));

      return $askare;
    } 

    return null;
  }

  public function update() {
    $query = DB::connection()->prepare('UPDATE Askare SET nimi = :nimi, lisayspaiva = :lisayspaiva, tarkeys = :tarkeys, status = :status, voimassaolopaiva = :voimassaolopaiva, kuvaus = :kuvaus WHERE id = :id');  
     $query->execute(array('nimi' => $this->nimi, 'lisayspaiva' => $this->lisayspaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus, 'id' => $this->id));
      $row = $query->fetch(); 
  }


 
  public function destroy() {
    $query = DB::connection()->prepare('DELETE FROM Askare WHERE id = :id');
    $query->execute(array('id' => $this->id));
    $row = $query->fetch();
                 
  }


  public function validate_nimi() {
    return parent::validate_string_length($this->nimi);
  }
  
  public function validate_lisayspaiva() {
	  return parent::validate_date($this->lisayspaiva);
  }
  
  public function validate_voimassaolopaiva() {
	  return parent::validate_date($this->voimassaolopaiva);
  }
	  


}
