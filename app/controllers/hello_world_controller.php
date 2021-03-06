<?php

require 'app/models/raakaaine.php';
require 'app/models/kayttaja.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('etusivu/etusivu.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        
       $testi = new Raakaaine(array(
           'nimi' => '',
           'kcalper100' => '',
           'proteiiniper100' => '',
           'hiilihydraatitper100' => '',
           'rasvaper100' => ''           
       ));
       $errors = $testi->errors();
       
       Kint::dump($errors);
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
