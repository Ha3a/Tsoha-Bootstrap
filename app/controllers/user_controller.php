<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'app/models/kayttaja.php';

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function createAccount() {
        View::make('kayttaja/rekisterointi.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['nimi'], $params['salasana']);

        if (!$kayttaja) {
            View::make('suunnitelmat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
        } else {
            $_SESSION['user'] = $kayttaja->id;

            Redirect::to('/ravintokirja/raakaaine', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/ravintokirja/raakaaine', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function store() {

        $params = $_POST;

        $attribuutit = array(
            'nimi' => $params['nimi'],
            'salasana' => $params['salasana'],
            'admin' => 'false'
        );

        $kayttaja = new Kayttaja($attribuutit);

        $kayttaja->save();

        Redirect::to('/login', array('message' => 'Käyttäjä luotu!'));
    }

}
