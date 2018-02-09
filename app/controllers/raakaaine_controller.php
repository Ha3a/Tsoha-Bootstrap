<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'app/models/raakaaine.php';
require 'app/models/kayttaja.php';


class RaakaaineController extends BaseController {

    public static function index() {

        $raakaaineet = Raakaaine::all();


        View::make('raakaaine/raakaaine.html', array('raakaaineet' => $raakaaineet));
    }
    
    public static function lisayssivu(){
        View::make('raakaaine/lisaaraakaaine.html');
    }

    public static function show($id) {

        $raakaaineet = Raakaaine::find($id);

        Kint::dump($raakaaineet);


        View::make('raakaaine/esittelysivu.html', array('raakaaineet' => $raakaaineet));
    }

    public static function store() {

        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'kcalper100' => $params['kcalper100'],
            'proteiiniper100' => $params['proteiiniper100'],
            'hiilihydraatitper100' => $params['hiilihydraatitper100'],
            'rasvaper100' => $params['rasvaper100']
        );

        $raakaaine = new Raakaaine($attributes);
        $errors = $raakaaine->errors();

        if (count($errors) == 0) {

            $raakaaine->save();
            Redirect::to('/ravintokirja/raakaaine/' . $raakaaine->id, array('message' => 'Raakaaine lisätty kirjastoon!'));
        } else {
            
            View::make('raakaaine/lisaaraakaaine.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $raakaaine = Raakaaine::find($id);
        View::make('raakaaine/muokkaussivu.html', array('raakaaineet' => $raakaaine));
    }

    
    
    
    public static function update($id) {

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kcalper100' => $params['kcalper100'],
            'proteiiniper100' => $params['proteiiniper100'],
            'hiilihydraatitper100' => $params['hiilihydraatitper100'],
            'rasvaper100' => $params['rasvaper100']
        );

        $raakaaine = new Raakaaine($attributes);
        $errors = $raakaaine->errors();

        if (count($errors) == 0) {

            $raakaaine->update();
            Redirect::to('/ravintokirja/raakaaine/' . $raakaaine->id, array('message' => 'Raakaaine muokattu!'));
        } else {
            $raakaaineet = Raakaaine::all();
            View::make('raakaaine/raakaaine.html', array('errors' => $errors, 'attributes' => $attributes, 'raakaaineet' => $raakaaineet));
        }
    }
    
    public static function destroy($id){
        
         $raakaaine = new Raakaaine(array('id' => $id));
        
         $raakaaine->destroy($id);
         
         Redirect::to('/ravintokirja/raakaaine', array('message' => 'Raakaaine poistettu!'));
    }

}


