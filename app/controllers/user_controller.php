<?php

  class UserController extends BaseController{

  public static function login() {
      View::make('muistilista/login.html');
  }
  
  public static function handle_login() {
    $params = $_POST;

    $user = User::authenticate($params['ktunnus'], $params['password']);

    if(!$user) {
      View::make('muistilista/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'ktunnus' => $params['ktunnus']));
    } else {
      $_SESSION['user'] = $user->id;

      Redirect::to('/muistilista', array('message' => 'Tervetuloa takaisin ' . $user->ktunnus . '!'));
    }
  }
  
  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }
  
}
