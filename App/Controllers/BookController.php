<?php

namespace Projet\Controllers;

class BookController extends Controller{


/*=======================================================*/
/*=======================================================*/
/*======================== ADMIN ========================*/
/*=======================================================*/
/*=======================================================*/

    

/*********************************************************/
/********************** PAGE LIVRES **********************/
/*********************************************************/
function livres(){
    $book = new \Projet\Models\BookModel();
    $allBooks = $book->allBooks();
    $books = $allBooks->fetchAll();
    return $this->viewAdmin("dashboard/books", $books);
}

function viewLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    return $this->viewAdmin("dashboard/book-view", $book);
}

function addLivre(){
    $books = new \Projet\Models\BookModel();
    return $this->viewAdmin("dashboard/book-add", $books);
}

function addLivrePost($data){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->addSingleBook($data);
    header('Location: indexAdmin.php?action=livres');
}

function modifyLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    return $this->viewAdmin("dashboard/book-modify", $book);
}

function modifyLivrePost($data){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->modifySingleBook($data);
    //$book = $oneBook->fetch();
    header('Location: indexAdmin.php?action=livres');
}

function deleteLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    return $this->viewAdmin("dashboard/book-delete.php",$book);
}








/*=======================================================*/
/*=======================================================*/
/*======================== FRONT ========================*/
/*=======================================================*/
/*=======================================================*/




function allBooks(){
    $book = new \Projet\Models\BookModel();
    $allBooks = $book->allBooks();
    $books = $allBooks->fetchAll();
    return $this->viewFront("all-books", $books);
}

function oneBook($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
   
    return $this->viewFront("one-book", $book);
}



}