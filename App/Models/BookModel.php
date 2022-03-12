<?php

namespace Projet\Models;

class BookModel extends Manager{
    
    public function allBooks(){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT id, title, created_at, location FROM books');
        $req->execute();
        return $req;
    }

    public function singleBook($id){
        $bdd =$this->dbConnect();
        // $req = $bdd->prepare('SELECT id, title, created_at, author, notation, genre, catchphrase, content, edition, linkEdition, picture, location, year_publication FROM books WHERE id = ?');
        $req = $bdd->prepare('SELECT * FROM books WHERE id=?');
        $req->execute(array($id));
        return $req;
    }

    public function countBooks(){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM books WHERE id');
        $req->execute();
        return $req;
    }


}

