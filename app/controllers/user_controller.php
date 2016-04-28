<?php

  class UserController extends BaseController{

  public static function login() {
      View::make('muistilista/login.html');
  }
  
  public static function handle_login() {
    $params = $_POST;

    $user = User::authenticate($params['kayttajatunnus'], $params['salasana']);

    if(!$user) {
      View::make('muistilista/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
    } else {
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->kayttajatunnus . '!'));
    }
  }
  
  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/muistilista/login', array('message' => 'Olet kirjautunut ulos!'));
  }
  
}
