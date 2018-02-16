<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'app/models/raakaaine.php';
require 'app/models/kayttaja.php';
require 'app/models/annos.php';

class AnnosController extends BaseController {

    public static function index() {

        $annos = Annos::all();


        View::make('annos/annos.html', array('annos' => $annos));
    }

    public static function lisayssivu() {
        View::make('annos/lisaaannos.html');
    }

    public static function show($id) {

        $annos = Annos::find($id);

        Kint::dump($annos);


        View::make('annos/esittelysivu.html', array('annos' => $annos));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'kcalper100' => $params['kcalper100'],
            'proteiiniper100' => $params['proteiiniper100'],
            'hiilihydraatitper100' => $params['hiilihydraatitper100'],
            'rasvaper100' => $params['rasvaper100']
        );

        $annos = new Raakaaine($attributes);
        $errors = $annos->errors();

        if (count($errors) == 0) {

            $annos->save();
            Redirect::to('/ravintokirja/annos/' . $annos->id, array('message' => 'Annos lisätty kirjastoon!'));
        } else {

            View::make('annos/lisaaannos.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();

        $annos = Annos::find($id);
        View::make('annos/muokkaussivu.html', array('annos' => $annos));
    }

    public static function update($id) {
        self::check_logged_in();

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kcalper100' => $params['kcalper100'],
            'proteiiniper100' => $params['proteiiniper100'],
            'hiilihydraatitper100' => $params['hiilihydraatitper100'],
            'rasvaper100' => $params['rasvaper100']
        );

        $annos = new Raakaaine($attributes);
        $errors = $annos->errors();

        if (count($errors) == 0) {

            $annos->update();
            Redirect::to('/ravintokirja/annos/' . $annos->id, array('message' => 'Annosta muokattu!'));
        } else {
            $annokset = Raakaaine::all();
            View::make('annos/annos.html', array('errors' => $errors, 'attributes' => $attributes, 'raakaaineet' => $annokset));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();

        $annos = new Raakaaine(array('id' => $id));

        $annos->destroy($id);

        Redirect::to('/ravintokirja/annos', array('message' => 'Annos poistettu!'));
    }

}
