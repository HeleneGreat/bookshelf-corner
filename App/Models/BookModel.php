<?php

namespace Projet\Models;

class BookModel extends Manager{

    public function countBooks(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM books WHERE id');
        $req->execute();
        $result = $req->fetch();
        return $result;
    }

    public function allBooks(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, title, author, picture, DATE_FORMAT(created_at, "%d %M %Y") AS date, location, slider 
            FROM books 
            ORDER BY id DESC'
        );
        $req->execute();
        return $req;
    }

    public function allBooksPagination($pagination){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, title, author, picture, DATE_FORMAT(created_at, "%d %M %Y") AS date, location, slider 
            FROM books 
            ORDER BY id DESC
            LIMIT :firstItem, :perPage');
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    public function singleBook($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT books.id, title, DATE_FORMAT(created_at, "%d %M %Y") AS date, author, notation, catchphrase, content, edition, linkEdition, books.picture, location, year_publication, category 
            FROM books 
            INNER JOIN genres 
            ON books.id_genre = genres.id 
            WHERE books.id = ?');
        $req->execute(array($id));
        return $req;
    }

    public function addSingleBook($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'INSERT INTO books(title, author, notation, catchphrase, id_genre, content, edition, linkEdition, location, year_publication) 
            VALUES(:newTitle, :newAuthor, :newNotation, :newCatchphrase, (SELECT id FROM genres WHERE category = :newGenre), :newContent, :newEdition, :newLinkEdition, :newLocation, :newYear_publication)');
        $req->execute($data);
        return $req;
    }

    public function modifySingleBook($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'UPDATE books 
            SET title = :newTitle, author = :newAuthor, notation = :newNotation, id_genre = (SELECT id FROM genres WHERE category = :newGenre), catchphrase = :newCatchphrase, content = :newContent, edition = :newEdition, linkEdition = :newLinkEdition, picture = :picture, location = :newLocation, year_publication = :newYear_publication 
            WHERE id = :id');
        $req->execute($data);
        return $req;
    }

    public function deleteBook($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM books WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }
    

    /**************************/
    /********* SLIDER *********/
    /**************************/
    
// All slider colomns are set to 0
    public function sliderOff(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE books SET slider = "0"');
        $req->execute();
        return $req;
    }

// The ones selected in the form are set to 1
    public function sliderOn($data){
        $bdd = $this->dbConnect();
        foreach($data as $slider){
            $req = $bdd->prepare('UPDATE books SET slider = "1" WHERE id = ?');
            $req->execute(array($slider));  
        }
        return $req;
    }

    /**************************/
    /********* GENRES *********/
    /**************************/

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

