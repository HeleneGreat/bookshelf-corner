<?php

namespace Projet\Controllers;

class BookController extends Controller{

    // First admin methods, then front

    function infoLivre($id){
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->singleBook($id);
        $book = $oneBook->fetch();
        return $book;
    }


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

    function noCover(){
        // Default image if no book cover is submited
        return "no-cover.png";
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
        header('Location: indexAdmin.php?action=livres');
    }

    function sliderSelection($data){
        // First, all books in the DBB are set to slider = 0
        $allBooks = new \Projet\Models\BookModel();
        $sliderOff = $allBooks->sliderOff();
        // Second, the books selected in the slider form are set to 1
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->sliderOn($data);
        header('Location: indexAdmin.php?action=livres');
    }

    function deleteLivre($id){
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->deleteBook($id);
        $book = $oneBook->fetch();
        header('Location: indexAdmin.php?action=livres');
    }







    /*=======================================================*/
    /*=======================================================*/
    /*======================== FRONT ========================*/
    /*=======================================================*/
    /*=======================================================*/




    function home(){
        $book = new \Projet\Models\BookModel();
        $allBooks = $book->allBooks();
        $books = $allBooks->fetchAll();
        return $this->viewFront("home", $books);
    }


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