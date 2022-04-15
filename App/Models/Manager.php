<?php

namespace Projet\Models;

class Manager{

    protected static function dbConnect(){

        try{
            $bdd = new \PDO('mysql:host=localhost;dbname=bookshelf_corner;charset=utf8', 'root', '');
            $bdd->query("SET lc_time_names = 'fr_FR'");
            return $bdd;
        }
        
        catch (\Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
}