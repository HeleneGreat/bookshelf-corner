<?php

namespace Projet\Models;

class GenreModel extends Manager
{

    // Get all genres
    public function allGenres(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, category, picture FROM genres ORDER BY category ASC');
        $req->execute();
        return $req;
    }
    
   // Get genre list for menus
    public function categoriesList(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, category
            FROM genres 
            ORDER BY category ASC');
        $req->execute();
        return $req;
    }
    
    // Get this category
    public function infoGenre($genreId){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, category, picture FROM genres WHERE id = ?');
        $req->execute(array($genreId));
        return $req;
    }

    // Add this category
    public function genreAddPost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO genres(category) VALUES (:newType)');
        $req->execute($data);
        return $req;
    }

    // Modify this category
    public function genreModifyPost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE genres SET category = :newType, picture = :picture WHERE id= :id');
        $req->execute($data);
        return $req;
    }

    // Delete this category
    public function deleteGenre($genreId){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM genres WHERE id = ?');
        $req->execute(array($genreId));
        return $req;
    }

}