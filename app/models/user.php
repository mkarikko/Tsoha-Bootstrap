<?php
class User extends BaseModel {
    public $id, $kayttajatunnus, $salasana;
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_kayttajatunnus');
    }
    public function authenticate($kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM User WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
            ));
            return $user;
            // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
        } else {
            return null;
            // Käyttäjää ei löytynyt, palautetaan null
        }
    }
     public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM User WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
            ));
            return $user;
        }
        return null;
    }
}
