<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'app/models/raakaaine.php';

class RaakaaineController extends BaseController {

    public static function index() {

        $raakaaineet = Raakaaine::all();


        View::make('raakaaine/raakaaine.html', array('raakaaineet' => $raakaaineet));
    }

    public static function show($id) {

        $raakaaineet = Raakaaine::find($id);
        
        Kint::dump($raakaaineet);


        View::make('raakaaine/muokkaussivu.html', array('raakaaineet' => $raakaaineet));
    }

    public static function store() {

        $params = $_POST;

        $raakaaine = new Raakaaine(array(
            'nimi' => $params['nimi'],
            'kcalper100' => $params['kcalper100'],
            'proteiiniper100' => $params['proteiiniper100'],
            'hiilihydraatitper100' => $params['hiilihydraatitper100'],
            'rasvaper100' => $params['rasvaper100']
        ));

        $raakaaine->save();

        Redirect::to('/ravintokirja/raakaaine');
    }

}
