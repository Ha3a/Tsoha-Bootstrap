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
require 'app/models/ruokailut.php';

class RuokailutController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();


        $ruokailut = Ruokailut::all($user_logged_in->id);

        $total = array();
        $total = Ruokailut::ravintoa($ruokailut);

        $annokset = Annos::all();

        $tiedoilla = array();

        $index = 0;

        foreach ($annokset as $annos) {



            $tiedoilla[$index] = Annosraakaaine::findRavinto($annos->id);

            $index++;
        }


        $tiedoilla2 = array();
        $index2 = 0;
        $idt = array();

        foreach ($ruokailut as $ruoka) {



            $tiedoilla2[$index2] = Annosraakaaine::findRavinto($ruoka['annos_id']);
            $tiedoilla2[$index2]['idd'] = $ruoka['0'];

            $index2++;
        }

        

        


        View::make('ruokailut/ruokailut.html', array('tiedot' => $tiedoilla, 'ruokailut' => $tiedoilla2, 'total' => $total));
    }

    public static function eat($aid) {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $attributes = array(
            'annos_id' => $aid,
            'kayttaja_id' => $user_logged_in->id
        );

        $ruokailu = new Ruokailut($attributes);

        $ruokailu->save();


        Redirect::to('/ravintokirja/ruokailut', array('message' => 'Syöty!'));
    }

    public static function destroy($aid) {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        
        $ruokailu = new Ruokailut(array('annos_id' => $aid, 'kayttaja_id' => $user_logged_in->id));
        
        $ruokailu->destroy($aid, $user_logged_in->id);
        
        
        Redirect::to('/ravintokirja/ruokailut', array('message' => 'Poistettu!'));
    }

}
