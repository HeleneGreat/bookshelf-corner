<?php

namespace Projet\Models;

class BookModel extends Manager{
    
    public function allBooks(){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT id, title, author, picture, created_at, location FROM books ORDER BY created_at DESC');
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




    public function addSingleBook($data){
        $bdd =$this->dbConnect();
        $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $req = $bdd->prepare('INSERT INTO books(title, author, notation, genre, catchphrase, content, edition, linkEdition, picture, location, year_publication) VALUES(:newTitle, :newAuthor, :newNotation, :newGenre,:newCatchphrase, :newContent, :newEdition, :newLinkEdition, :newPicture, :newLocation, :newYear_publication)');
        $req->execute($data);
        return $req;
    }

    public function modifySingleBook($data){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('UPDATE books SET title = :newTitle, author = :newAuthor, notation = :newNotation, genre = :newGenre, catchphrase = :newCatchphrase, content = :newContent, edition = :newEdition, linkEdition = :newLinkEdition, picture = :newPicture, location = :newLocation, year_publication = :newYear_publication WHERE id= :id');
        $req->execute($data);
        return $req;
    }

    public function countBooks(){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM books WHERE id');
        $req->execute();
        return $req;
    }


}

