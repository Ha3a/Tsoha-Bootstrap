<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ruokailut extends BaseModel {

    public $id, $annos_id, $kayttaja_id;

    public function __construct($attribuutit) {
        parent::__construct($attribuutit);
    }

    public static function all($kid) {

        $query = DB::connection()->prepare('SELECT * FROM Ruokailut, Annos WHERE Ruokailut.kayttaja_id = :kayttaja_id AND Annos.id = Ruokailut.annos_id');
        $query->execute(array('kayttaja_id' => $kid));

        $rows = $query->fetchAll();
        $ruokailut = array();


        foreach ($rows as $row) {

            $ruokailut[] = $row;
        }

        return $ruokailut;
    }

    public function save() {

        $querry = DB::connection()->prepare('INSERT INTO Ruokailut (annos_id, kayttaja_id) VALUES (:annos_id, :kayttaja_id)');

        $querry->execute(array('annos_id' => $this->annos_id, 'kayttaja_id' => $this->kayttaja_id));

        $row = $querry->fetch();
    }

    public function destroy($aid, $kid) {
        $query = DB::connection()->prepare('DELETE from Ruokailut WHERE id = :id AND kayttaja_id = :kayttaja_id');
        $query->execute(array('id' => $aid, 'kayttaja_id' => $kid));
    }

    public static function ravintoa($eaten) {

        $kcal = 0;
        $proteiini = 0;
        $hiilihydraatit = 0;
        $rasva = 0;

        foreach ($eaten as $eat) {

            $dataa = Annosraakaaine::findRavinto($eat['id']);

            $kcal = $kcal + $dataa['kcal'];
            $proteiini = $proteiini + $dataa['proteiini'];
            $hiilihydraatit = $hiilihydraatit + $dataa['hiilihydraatit'];
            $rasva = $rasva + $dataa['rasva'];
        }

        $tiedot = array();

        $tiedot = ['kcal' => $kcal,
            'proteiini' => $proteiini,
            'hiilihydraatit' => $hiilihydraatit,
            'rasva' => $rasva
        ];

        return $tiedot;
    }

}
