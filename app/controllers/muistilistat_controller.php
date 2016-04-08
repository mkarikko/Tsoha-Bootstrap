<?php

class MuistilistaController extends BaseController{
	
	
    public static function index(){
		$muistilistat = Muistilista::all();
		View::make('muistilista/index.html', array('muistilistat' => $muistilistat));  	
	}
	
}
