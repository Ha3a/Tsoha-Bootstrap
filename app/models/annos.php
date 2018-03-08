<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Annos extends BaseModel {

    public $id, $nimi;

    public function __construct($attribuutit) {
        parent::__construct($attribuutit);
        $this->validators = array('validate_name');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Annos');

        $query->execute();

        $rows = $query->fetchAll();
        $annos = array();

        foreach ($rows as $row) {

            $annos[] = new Annos(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }
        return $annos;
    }
    
    public function getID(){
        return $this->id;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Annos WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $annos = new Annos(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));

            return $annos;
        }

        return null;
    }

    public function save() {

        $querry = DB::connection()->prepare('INSERT INTO Annos (nimi) VALUES (:nimi) RETURNING id');

        $querry->execute(array('nimi' => $this->nimi));

        $row = $querry->fetch();

        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 2) {
            $errors[] = 'Nimen pituus on oltava vähintään kaksi merkkiä!';
        }


        return $errors;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Annos SET nimi = :nimi WHERE id = :id');

        $query->execute(array(
            'nimi' => $this->nimi,
            'id' => $this->id,
        ));
    }



    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE from Annos WHERE id = :id');
        $query->execute(array('id' => $id));
    }

}
