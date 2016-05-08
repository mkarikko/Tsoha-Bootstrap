<?php


class Muistilista extends BaseModel {

  public $id, $kayttaja_id, $nimi, $tarkeys, $luomispaiva, $status, $voimassaolopaiva, $kuvaus, $askareet;

  public function __construct($attributes) {
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_luomispaiva', 'validate_voimassaolopaiva');
  }

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Muistilista (nimi, luomispaiva, tarkeys, status, voimassaolopaiva, kuvaus, kayttaja_id) VALUES (:nimi, :luomispaiva, :tarkeys, :status, :voimassaolopaiva, :kuvaus, :kayttaja_id) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'luomispaiva' => $this->luomispaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus, 'kayttaja_id' =>$this->kayttaja_id));
      $row = $query->fetch();
//Kint::trace();
//Kint::dump($row);

      $this->id = $row['id'];
      
      if ($this->askareet !== null) {
		  foreach ($this->askareet as $askare) {
                $query = DB::connection()->prepare('INSERT INTO 
         Muistilistan_askare(askare_id, id) VALUES (:askare_id, :id)');
                $query->execute(array('askare' => $askare, 'id' => $this->id));
                $row = $query->fetch();
            }
        }
  }

  public static function all() {
    
    $query = DB::connection()->prepare('SELECT * FROM Muistilista' /* *WHERE kayttaja_id = :kayttaja_id'*/);
    $query->execute();/*(array('kayttaja_id' => $_SESSION['user']));  */
    $rows = $query->fetchAll();
    $muistilistat = array();

// KASA TURHAA LINKITYSYRITYSTÄ
/*    foreach ($rows as $row) {
            $query = DB::connection()->prepare('SELECT DISTINCT Askare.nimi, Askare.id, Askare.kayttaja_id FROM'
                    . ' Muistilista, Muistilistan_askare, Askare WHERE Muistilista.id'
                    . '=Muistilistan_askare.muistilista_id AND Askare.id'
                    . '=Muistilistan_askare.askare_id AND Muistilista.id=:id');
            $query->execute(array('id' => $row['id']));
            $rows = $query->fetchAll();
            $askareet = array();

    foreach($rows as $row) {
      $askareet[] = new Askare(array(
        'askare_id' => $row['askare_id'],
        'askare_nimi' => $row['askare_nimi'],
        'kayttaja_id' => $row[$_SESSION['user']],
      ));
  */  
    foreach($rows as $row) {
      $muistilistat[] = new Muistilista(array(
        'kayttaja_id' => $row[$_SESSION['user']],
        'id' => $row['id'],       
        'nimi' => $row['nimi'],
        'tarkeys' => $row['tarkeys'],
        'luomispaiva' => $row['luomispaiva'],
        'status' => $row['status'],
        'voimassaolopaiva' => $row['voimassaolopaiva'],
        'kuvaus' => $row['kuvaus']
      //  'askareet' => $askareet
      ));
      
    //  unset($askareet);
    }

    return $muistilistat;
   // }
  } 

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Muistilista WHERE id = :id LIMIT 1');
    $query->execute(array('id' => (int)$id));
    $row = $query->fetch();

    if($row) {
      $muistilista = new Muistilista(array(
        'id' => $row['id'],
        'kayttaja_id' => $row['kayttaja_id'],
        'nimi' => $row['nimi'],
        'luomispaiva' => $row['luomispaiva'],
        'tarkeys' => $row['tarkeys'],
        'status' => $row['status'],
        'voimassaolopaiva' => $row['voimassaolopaiva'],
        'kuvaus' => $row['kuvaus']
      ));

      return $muistilista;
    } 

    return null;
  }


  public function destroy() {
  /*  $query = DB::connection()->prepare('DELETE FROM Muistilistan_askare WHERE id = :id');
    $query->execute(array('id' => $this->id));
    $row = $query->fetch();
    */
    $query = DB::connection()->prepare('DELETE FROM Muistilista WHERE id = :id');
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
    


  public function update() {
    $query = DB::connection()->prepare('UPDATE Muistilista SET nimi = :nimi, luomispaiva = :luomispaiva, tarkeys = :tarkeys, status = :status, voimassaolopaiva = :voimassaolopaiva, kuvaus = :kuvaus WHERE id = :id');  
     $query->execute(array('nimi' => $this->nimi, 'luomispaiva' => $this->luomispaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus, 'id' => $this->id));
      $row = $query->fetch(); 
  } 
 
 //LISÄÄ TURHAA LINKITYSYRITYSTÄ 
 /*  $tyhjennys = DB::connection()->prepare('DELETE FROM Muistilistan_askare WHERE id = :id');
        $tyhjennys->execute(array('kayttaja_id' => $_SESSION['user']));
        $tyhjennysrivi = $tyhjennys->fetch();
        if ($this->askareet !== null) {
            foreach ($this->askareet as $askare) {
                $query = DB::connection()->prepare('INSERT INTO Muistilistan_askare(askare_id, id) VALUES (:askare_id, :id)');
                $query->execute(array('id' => $this->id, 'askare_id' => $askare));
                $row = $query->fetch();
   */   
        
  
  
/*  public function update() {
    $query = DB::connection()->prepare('UPDATE Muistilista SET nimi = :nimi, luomispaiva = :luomispaiva, tarkeys = :tarkeys, status = :status, voimassaolopaiva = :voimassaolopaiva, kuvaus = :kuvaus WHERE id = :id, kayttaja_id = :kayttaja_id');  
     $query->execute(array('nimi' => $this->nimi, 'luomispaiva' => $this->luomispaiva, 'tarkeys' => $this->tarkeys, 'status' => $this->status, 'voimassaolopaiva' => $this->voimassaolopaiva, 'kuvaus' => $this->kuvaus, 'id' => $this->id, 'kayttaja_id' => $this->kayttaja_id));
      $row = $query->fetch(); 
  */



}
