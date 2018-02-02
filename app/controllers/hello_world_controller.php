<?php

require 'app/models/raakaaine.php';
class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        
//        $test = Raakaaine::find(1);
        $raakaaineet = Raakaaine::all();
        
//        Kint::dump($test);
        Kint::dump($raakaaineet);
        
//        View::make('helloworld.html');
    }
    
    

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function luoannos() {
        View::make('suunnitelmat/luoannos.html');
    }

    public static function muokkaussivu() {
        View::make('suunnitelmat/muokkaussivu.html');
    }

    public static function raakaaine() {
        View::make('suunnitelmat/raakaaine.html');
    }

    public static function ruoka() {
        View::make('suunnitelmat/ruoka.html');
    }
    
    public static function annoksenmuokkaus() {
        View::make('suunnitelmat/annoksenmuokkaus.html');
    }
    
    
    
    

}
