<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Annosraakaaine extends BaseModel {

    public $annos_id, $raakaaine_id, $maara;

    public function __construct($attribuutit) {
        parent::__construct($attribuutit);
        $this->validators = array('validate_maara');
    }

    public function save() {

        $querry = DB::connection()->prepare('INSERT INTO Annosraakaaine (annos_id, raakaaine_id, maara) VALUES (:annos_id, :raakaaine_id, :maara)');

        $querry->execute(array('annos_id' => $this->annos_id, 'raakaaine_id' => $this->raakaaine_id, 'maara' => $this->maara));

        $row = $querry->fetch();
    }



    public function validate_maara() {
        $errors = array();
        if ($this->maara == '' || $this->maara == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (!is_numeric($this->maara) && $this->maara != null) {
            $errors[] = 'Määrän täytyy olla luku!';
        }



        return $errors;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT Raakaaine.nimi AS nimi, Annosraakaaine.maara AS maara, Raakaaine.id AS rid FROM Raakaaine, Annosraakaaine WHERE Raakaaine.id = Annosraakaaine.raakaaine_id AND Annosraakaaine.annos_id = :id');
        $query->execute(array('id' => $id));
//        $row = $query->fetch();

        $raakaaineet = array();

        $index = 0;

        while ($row = $query->fetch()) {

            $raakaaineet[$index] = array(
                'nimi' => $row['nimi'],
                'maara' => $row['maara'],
                'rid' => $row['rid']
            );
            $index++;
        }
        return $raakaaineet;
    }

    public static function findRavinto($id) {

        $query = DB::connection()->prepare('SELECT Raakaaine.nimi AS nimi, Raakaaine.kcalper100 AS kcal, Raakaaine.proteiiniper100 AS proteiini, Raakaaine.hiilihydraatitper100 AS hiilihydraatit, Raakaaine.rasvaper100 AS rasva, Annosraakaaine.maara AS maara FROM Raakaaine, Annosraakaaine WHERE Raakaaine.id = Annosraakaaine.raakaaine_id AND Annosraakaaine.annos_id = :id');
        $query->execute(array('id' => $id));
//        $row = $query->fetch();

        $raakaaineet = array();

        $index = 0;

        while ($row = $query->fetch()) {

            $maara = $row['maara'] / 100;

            $raakaaineet[$index] = array(
                'nimi' => $row['nimi'],
                'kcal' => $row['kcal'] * $maara,
                'proteiini' => $row['proteiini'] * $maara,
                'hiilihydraatit' => $row['hiilihydraatit'] * $maara,
                'rasva' => $row['rasva'] * $maara
            );
            $index++;
        }

        $tiedot = array();

        $annos = Annos::find($id);

        $id = $annos->id;
        $nimi = $annos->nimi;
        $kcal = 0;
        $proteiini = 0;
        $hiilihydraatit = 0;
        $rasva = 0;


        foreach ($raakaaineet as $raakaaine) {
            $kcal = $kcal + $raakaaine['kcal'];
            $proteiini = $proteiini + $raakaaine['proteiini'];
            $hiilihydraatit = $hiilihydraatit + $raakaaine['hiilihydraatit'];
            $rasva = $rasva + $raakaaine['rasva'];
        }

        $tiedot = ['kcal' => $kcal,
            'proteiini' => $proteiini,
            'hiilihydraatit' => $hiilihydraatit,
            'rasva' => $rasva,
            'nimi' => $nimi,
            'id' => $id
        ];

        return $tiedot;
    }

    public function update() {
        $querry = DB::connection()->prepare('UPDATE Annosraakaaine SET maara = :maara WHERE annos_id = :annos_id AND raakaaine_id = :raakaaine_id');

        $querry->execute(array('annos_id' => $this->annos_id, 'raakaaine_id' => $this->raakaaine_id, 'maara' => $this->maara));

        $row = $querry->fetch();
    }

    public function destroy($aid, $rid) {
        $query = DB::connection()->prepare('DELETE from Annosraakaaine WHERE annos_id = :annos_id AND raakaaine_id = :raakaaine_id');
        $query->execute(array('annos_id' => $aid, 'raakaaine_id' => $rid));
    }

}
