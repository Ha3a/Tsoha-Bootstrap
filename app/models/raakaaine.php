<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Raakaaine extends BaseModel {

    public $id, $nimi, $kcalper100, $proteiiniper100, $hiilihydraatitper100, $rasvaper100;

    public function __construct($attribuutit) {
        parent::__construct($attribuutit);
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Raakaaine');

        $query->execute();

        $rows = $query->fetchAll();
        $raakaaineet = array();

        foreach ($rows as $row) {

            $raakaaineet[] = new Raakaaine(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kcalper100' => $row['kcalper100'],
                'proteiiniper100' => $row['proteiiniper100'],
                'hiilihydraatitper100' => $row['hiilihydraatitper100'],
                'rasvaper100' => $row['rasvaper100']
            ));
        }
        return $raakaaineet;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Raakaaine WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $raakaaine = new Raakaaine(array(
                'id' => $row['id'],
                'Nimi' => $row['nimi'],
                'kcalper100' => $row['kcalper100'],
                'proteiiniper100' => $row['proteiiniper100'],
                'hiilihydraatitper100' => $row['hiilihydraatitper100'],
                'rasvaper100' => $row['rasvaper100']
            ));

            return $raakaaine;
        }

        return null;
    }
    
    
    
    
    
    public function save(){
        
        $querry = DB::connection()->prepare('INSERT INTO Raakaaine (nimi, kcalper100, proteiiniper100, hiilihydraatitper100, rasvaper100) VALUES (:nimi, :kcalper100, :proteiiniper100, :hiilihydraatitper100, :rasvaper100) RETURNING id');
        
        $querry->execute(array('nimi' => $this->nimi, 'kcalper100' => $this->kcalper100, 'proteiiniper100' => $this->proteiiniper100, 'hiilihydraatitper100' => $this->hiilihydraatitper100, 'rasvaper100' => $this->rasvaper100));
        
        $row = $querry->fetch();
        
        $this->id = $row['id'];
        
    }
    

}
