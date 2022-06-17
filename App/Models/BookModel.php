<?php

namespace Projet\Models;

class BookModel extends Manager
{

    /*********************************/
    /************* FRONT *************/
    /*********************************/
    // Get last books for the footer
    public function lastBooks($number){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT id, title, author, picture
            FROM books 
            ORDER BY id DESC
            LIMIT {$number}");
        $req->execute();
        return $req;
    }

    /********************************/
    /************* BACK *************/
    /********************************/
    // Count all books
    public function countBooks()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM books WHERE id');
        $req->execute();
        $result = $req->fetch();
        return $result;
    }

    // Get all books
    public function allBooks($genreId = null)
    {
        if($genreId == null){
            $genre = '';
        }else{
            $genre = 'WHERE id_genre = ' . $genreId;
        }
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT books.id, title, id_genre AS genreId, author, books.picture AS bookPicture, DATE_FORMAT(created_at, '%d %M %Y') AS date, slider
            FROM books
            {$genre}
            ORDER BY id DESC"
        );
        $req->execute();
        return $req;
    }

    // Get all books with a pagination
    public function allBooksPagination($pagination, $genreId)
    {
        if($genreId > 0){
            $category = "WHERE genres.id = " . $genreId;
        }else{
            $category = "";
        }
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT genres.id AS genreId, category, genres.picture AS catPicture, 
            books.id, title, books.picture AS bookPicture, DATE_FORMAT(created_at, '%d %M %Y') AS date 
            FROM books
            INNER JOIN genres 
            ON genres.id = books.id_genre
            {$category}
            ORDER BY books.id DESC
            LIMIT :firstItem, :perPage");
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    // Get one book information
    public function singleBook($bookId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT books.id, title, DATE_FORMAT(created_at, "%d %M %Y") AS date, author, notation, catchphrase, content, books.picture AS picture, year_publication, category, genres.picture AS catPicture, administrators.pseudo
            FROM books 
            INNER JOIN genres 
            ON books.id_genre = genres.id 
            INNER JOIN administrators
            ON books.id_admin = administrators.id
            WHERE books.id = ?');
        $req->execute(array($bookId));
        return $req;
    }

    // Add this book to the database
    public function addSingleBook($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'INSERT INTO books(title, author, notation, catchphrase, id_genre, content, year_publication, id_admin) 
            VALUES(:newTitle, :newAuthor, :newNotation, :newCatchphrase, (SELECT id FROM genres WHERE category = :newGenre), :newContent, :newYear_publication, :adminId)');
        $req->execute($data);
        return $req;
    }

    // Modify this book
    public function modifySingleBook($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'UPDATE books 
            SET title = :newTitle, author = :newAuthor, notation = :newNotation, id_genre = (SELECT id FROM genres WHERE category = :newGenre), catchphrase = :newCatchphrase, content = :newContent, picture = :picture, year_publication = :newYear_publication 
            WHERE id = :id');
        $req->execute($data);
        return $req;
    }

    // Delete this book
    public function deleteBook($bookId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM books WHERE id = ?');
        $req->execute(array($bookId));
        return $req;
    }

    // When a genre is delete, update all its associated books to the "Other" category
    public function updateBookBeforeDeleteGenre($genreId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'UPDATE books 
            SET id_genre = 21 
            WHERE id_genre = ?');
        $req->execute(array($genreId));
        return $req;
    }

    /**********************************/
    /************* SLIDER *************/
    /**********************************/
    // All slider colomns are set to 0
    public function sliderOff()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE books SET slider = "0"');
        $req->execute();
        return $req;
    }

    // The ones selected in the form are set to 1
    public function sliderOn($data)
    {
        $bdd = $this->dbConnect();
        foreach($data as $slider){
            $req = $bdd->prepare('UPDATE books SET slider = "1" WHERE id = ?');
            $req->execute(array($slider));  
        }
        return $req;
    }

}

