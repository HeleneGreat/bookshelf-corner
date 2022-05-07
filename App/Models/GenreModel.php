<?php

namespace Projet\Models;

class GenreModel extends Manager{

    public function allGenres(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, category, picture FROM genres ORDER BY category ASC');
        $req->execute();
        return $req;
    }
    
    public function categoriesList(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, category
            FROM genres 
            ORDER BY category ASC');
        $req->execute();
        return $req;
    }
    
    public function infoGenre($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, category, picture FROM genres WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }

    public function genreAddPost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO genres(category) VALUES (:newType)');
        $req->execute($data);
        return $req;
    }

    public function genreModifyPost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE genres SET category = :newType, picture = :picture WHERE id= :id');
        $req->execute($data);
        return $req;
    }

    public function deleteGenre($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM genres WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }

}