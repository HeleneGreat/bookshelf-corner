<?php

namespace Projet\Models;

class Manager{

    protected static function dbConnect(){

        try{
            $bdd = new \PDO('mysql:host=localhost;dbname=bookshelf_corner;charset=utf8', 'root', '');
            return $bdd;
        }
        
        catch (\Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
}