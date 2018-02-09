<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Kayttaja extends BaseModel {

    public $id, $nimi, $salasana, $admin;

    public function __construct($attribuutit) {
        parent::__construct($attribuutit);
    }

    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();

        if ($row) {

            $user = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'admin' => $row['admin']
            ));

            return $user;
        } else {

            return null;
        }
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new Kayttaja(array(
                
                
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'admin' => $row['admin']
                    
                    
            ));
            return $user;
        }
        return null;
    }

}
