<?php
class User extends BaseModel {
    
    public $id, $ktunnus, $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    //    $this->validators = array('validate_ktunnus');
    }
    
    public function authenticate($ktunnus, $password) {        
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE ktunnus = :ktunnus AND password = :password LIMIT 1');
        $query->execute(array('ktunnus' => $ktunnus, 'password' => $password));
        $row = $query->fetch();
//        Kint::dump($ktunnus);
//        die("tuleeko tänne");
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'ktunnus' => $row['ktunnus'],
                'password' => $row['password'],
            ));
            return $user;
            // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
        } else {
            return null;
            // Käyttäjää ei löytynyt, palautetaan null
        
        }
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'ktunnus' => $row['ktunnus'],
                'password' => $row['password'],
            ));
            return $user;
        }
        return null;
    }
}
