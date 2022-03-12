<?php

namespace Projet\Models;

class BookModel extends Manager{

    public int $id;    
    public string $title;
    public string $created_at;
    public string $author;
    public string $notation;
    public string $genre;
    public string $catchphrase;
    public string  $content;

    public static function infoBooks(){

        $bdd = self::dbConnect();
        // $req = $bdd->prepare('SELECT id, title, created_at, author, notation, genre, catchphrase, content, edition, linkEdition, picture, location, year_publication FROM books');
        $req = $bdd->prepare('SELECT * FROM books');
        $req->execute();
        $books = [];
        foreach( $req->fetchAll() as $book){
            array_push($books, new self($book));
        }

        return $books;
    }
    
    public static function infoBook($id){
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT * FROM books WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }


    function __construct($data)
    {
        $this->id = $data['ID'];
        $this->title = $data['title'];
        $this->created_at = $data['created_at'];
        $this->author = $data['author'];
        $this->notation = $data['notation'];
        $this->genre = $data['genre'];
        $this->catchphrase = $data['catchphrase'];
        $this->content = $data['content'];
    }



}

