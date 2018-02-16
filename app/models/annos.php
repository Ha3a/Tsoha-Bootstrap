<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Annos extends BaseModel {

    public $id, $nimi, $kcalper100, $proteiiniper100, $hiilihydraatitper100, $rasvaper100;

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
                'nimi' => $row['nimi'],
                'kcalper100' => $row['kcalper100'],
                'proteiiniper100' => $row['proteiiniper100'],
                'hiilihydraatitper100' => $row['hiilihydraatitper100'],
                'rasvaper100' => $row['rasvaper100']
            ));
        }
        return $annos;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Annos WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $annos = new Annos(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kcalper100' => $row['kcalper100'],
                'proteiiniper100' => $row['proteiiniper100'],
                'hiilihydraatitper100' => $row['hiilihydraatitper100'],
                'rasvaper100' => $row['rasvaper100']
            ));

            return $annos;
        }

        return null;
    }

    public function save() {

        $querry = DB::connection()->prepare('INSERT INTO Annos (nimi, kcalper100, proteiiniper100, hiilihydraatitper100, rasvaper100) VALUES (:nimi, :kcalper100, :proteiiniper100, :hiilihydraatitper100, :rasvaper100) RETURNING id');

        $querry->execute(array('nimi' => $this->nimi, 'kcalper100' => $this->kcalper100, 'proteiiniper100' => $this->proteiiniper100, 'hiilihydraatitper100' => $this->hiilihydraatitper100, 'rasvaper100' => $this->rasvaper100));

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
        if ($this->kcalper100 == '' || $this->kcalper100 == null) {
            $errors[] = 'KcalPer100 ei saa olla tyhjä!';
        }
        if ($this->kcalper100 < 0) {
            $errors[] = 'KcalPer100 ei saa olla negatiivinen!';
        }
        if (!is_numeric($this->kcalper100) && $this->hiilihydraatitper100 != null) {
            $errors[] = 'KcalPer100 täytyy olla luku!';
        }
        if ($this->proteiiniper100 == '' || $this->proteiiniper100 == null) {
            $errors[] = 'ProteiiniPer100 ei saa olla tyhjä!';
        }
        if ($this->proteiiniper100 < 0) {
            $errors[] = 'ProteiiniPer100 ei saa olla negatiivinen!';
        }
        if (!is_numeric($this->proteiiniper100) && $this->proteiiniper100 != null) {
            $errors[] = 'ProteiiniPer100 täytyy olla luku!';
        }
        if ($this->hiilihydraatitper100 == '' || $this->hiilihydraatitper100 == null) {
            $errors[] = 'HiilihydraatitPer100 ei saa olla tyhjä!';
        }
        if ($this->hiilihydraatitper100 < 0) {
            $errors[] = 'HiilihydraatitPer100 ei saa olla negatiivinen!';
        }
        if (!is_numeric($this->hiilihydraatitper100) && $this->hiilihydraatitper100 != null) {
            $errors[] = 'HiilihydraatitPer100 täytyy olla luku!';
        }
        if ($this->rasvaper100 == '' || $this->rasvaper100 == null) {
            $errors[] = 'RasvaPer100 ei saa olla tyhjä!';
        }
        if ($this->rasvaper100 < 0) {
            $errors[] = 'RasvaPer100 ei saa olla negatiivinen!';
        }
        if (!is_numeric($this->rasvaper100) && $this->rasvaper100 != null) {
            $errors[] = 'RasvaPer100 täytyy olla luku!';
        }
        
        return $errors;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Annos SET nimi = :nimi, kcalper100 = :kcalper100, proteiiniper100 = :proteiiniper100, 
                hiilihydraatitper100 = :hiilihydraatitper100, rasvaper100 = :rasvaper100 WHERE id = :id');

        $query->execute(array(
            'nimi' => $this->nimi,
            'kcalper100' => $this->kcalper100,
            'proteiiniper100' => $this->proteiiniper100,
            'hiilihydraatitper100' => $this->hiilihydraatitper100,
            'rasvaper100' => $this->rasvaper100,
            'id' => $this->id,
        ));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE from Annos WHERE id = :id');
        $query->execute(array('id' => $id));
    }

}
