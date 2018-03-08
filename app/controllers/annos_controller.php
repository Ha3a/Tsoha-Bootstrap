<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'app/models/raakaaine.php';
require 'app/models/kayttaja.php';
require 'app/models/annos.php';
require 'app/models/annosraakaaine.php';

class AnnosController extends BaseController {

    public static function index() {

        $annokset = Annos::all();

        $tiedoilla = array();
        
        $index = 0;
        
        foreach ($annokset as $annos) {
            
            
            
            $tiedoilla[$index] = Annosraakaaine::findRavinto($annos->id);
            
            $index++;
            
        }
        
//        $tiedoilla = Annosraakaaine::findRavinto(1);

        Kint::dump($tiedoilla);
        
        View::make('annos/annos.html', array('annos' => $annokset, 'tiedot' => $tiedoilla));
    }

    public static function lisayssivu() {
        View::make('annos/lisaaannos.html');
    }

    public static function show($id) {

        $annos = Annos::find($id);

        Kint::dump($annos);
        
        
        $annosraakaaineet = Annosraakaaine::find($id);

         Kint::dump($annosraakaaineet);

        View::make('annos/esittelysivu.html', array('annos' => $annos, 'raakaaineet' => $annosraakaaineet));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi']
        );

        $annos = new Annos($attributes);
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

        $raakaaineet = Raakaaine::all();

        Kint::dump($raakaaineet);

        $annos = Annos::find($id);
        View::make('annos/muokkaussivu.html', array('annos' => $annos, 'raakaaineet' => $raakaaineet));
    }

    public static function update($id) {
        self::check_logged_in();

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi']
        );

        $annos = new Annos($attributes);
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

        $annos = new Annos(array('id' => $id));

        $annos->destroy($id);

        Redirect::to('/ravintokirja/annos', array('message' => 'Annos poistettu!'));
    }

    public static function lisaaAnnokseen($aid, $rid) {
        self::check_logged_in();

        $raakaaineet = Raakaaine::all();
        $annos = Annos::find($aid);
        $raakaaine = Raakaaine::find($rid);

        $params = $_POST;




        $attributes = array(
            'annos_id' => $aid,
            'raakaaine_id' => $rid,
            'maara' => $params['maara']
        );


        $annosraakaaine = new Annosraakaaine($attributes);

        $annosraakaaine->save();

//        Kint::dump($annosraakaaine);




        Redirect::to('/ravintokirja/annos/' . $annos->id, array('message' => 'Lisätty!'));
    }

}
