<?php

namespace Projet\Models;

class Manager
{

    protected static function dbConnect()
    {
        try{
            $bdd = new \PDO('mysql:host=localhost;dbname=bookshelf_corner;charset=utf8', 'root', '');
            $bdd->query("SET lc_time_names = 'fr_FR'");
            return $bdd;
        }        
        catch (\Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function updatePicture($data, $table)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("UPDATE {$table} SET picture = :picture WHERE id = :id");
        $req->execute($data);
        return $req;
    }

    public function getId($table, $column, $identifiant)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT id
            FROM {$table}
            WHERE {$column} = '{$identifiant}'"
        );
        $req->execute();
        return $req;
    }

    public function checkForDuplicate($table, $column, $data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT *
            FROM {$table}
            WHERE {$column} = '{$data}'"
        );
        $req->execute();
        return $req;
    }

    public function countItems($table)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT COUNT(id) AS nb_items
            FROM {$table}"
        );
        $req->execute();
        $result = $req->fetch();
        $nbItems = $result['nb_items'];
        return $nbItems;
    }

}