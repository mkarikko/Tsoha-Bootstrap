<?php

class Askare extends BaseModel {

  public $id, $kayttaja_id, $muistilista_id, $nimi, $tarkeys, $luomispaiva, $status, $voimassaolopaiva, $kuvaus;

  public function __construct($attributes) {
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_luomispaiva', 'validate_voimassaolopaiva');
  }

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Askare (nimi, luomispaiva, tarkeys, status, voimassaolopaiva, kuvaus) VALUES (:nimi, :luomispaiva, :tarkeys, :status, :voimassaolopaiva, :kuvaus) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'luomispaiva' => $this->luomispaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus));
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
        'luomispaiva' => $row['luomispaiva'],
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
        'luomispaiva' => $row['luomispaiva'],
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
    $query = DB::connection()->prepare('UPDATE Askare SET nimi = :nimi, luomispaiva = :luomispaiva, tarkeys = :tarkeys, status = :status, voimassaolopaiva = :voimassaolopaiva, kuvaus = :kuvaus WHERE id = :id');  
     $query->execute(array('nimi' => $this->nimi, 'luomispaiva' => $this->luomispaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus, 'id' => $this->id));
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
  
  public function validate_luomispaiva() {
	  return parent::validate_date($this->luomispaiva);
  }
  
  public function validate_voimassaolopaiva() {
	  return parent::validate_date($this->voimassaolopaiva);
  }
	  


}
