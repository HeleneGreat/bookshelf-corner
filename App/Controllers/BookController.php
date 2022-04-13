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

    function infoGenre($id){
        $genres = new \Projet\Models\BookModel();
        $oneGenre = $genres->infoGenre($id);
        $genre = $oneGenre->fetch();
        return $genre;
    }


    /*=======================================================*/
    /*=======================================================*/
    /*======================== ADMIN ========================*/
    /*=======================================================*/
    /*=======================================================*/

        

    /*********************************************************/
    /********************** PAGE LIVRES **********************/
    /*********************************************************/

    
    /**************************/
    /********* LIVRES *********/
    /**************************/
    function livres(){
        $book = new \Projet\Models\BookModel();
        $allBooks = $book->allBooks();
        $books = $allBooks->fetchAll();

        $genre = new \Projet\Models\BookModel();
        $allGenres = $genre->allGenres();
        $genres = $allGenres->fetchAll();
        $datas = array_merge($books, $genres);
        return $this->viewAdmin("dashboard/books", $datas);
    }

    function addLivre(){
        $books = new \Projet\Models\BookModel();
        $addCats = $books->categoriesList();
        $cats = $addCats->fetchAll();
        return $this->viewAdmin("dashboard/book-add", $cats);
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

    function viewLivre($id){
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->singleBook($id);
        $book = $oneBook->fetch();
        return $this->viewAdmin("dashboard/book-view", $book);
    }
  
    function modifyLivre($id){
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->singleBook($id);
        $book = $oneBook->fetch();

        $genre = new \Projet\Models\BookModel();
        $allGenres = $genre->categoriesList();
        $genres = $allGenres->fetchAll();
        $datas = [
            "book" => $book,
            "genres" => $genres
        ] ;
        return $this->viewAdmin("dashboard/book-modify", $datas);
    }

    function modifyLivrePost($data){
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->modifySingleBook($data);
        header('Location: indexAdmin.php?action=livres');
    }

    function deleteLivre($id){
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->deleteBook($id);
        $book = $oneBook->fetch();
        header('Location: indexAdmin.php?action=livres');
    }
    
    /**************************/
    /********* SLIDER *********/
    /**************************/
    function sliderSelection($data){
        // First, all books in the DBB are set to slider = 0
        $allBooks = new \Projet\Models\BookModel();
        $sliderOff = $allBooks->sliderOff();
        // Second, the books selected in the slider form are set to 1
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->sliderOn($data);
        header('Location: indexAdmin.php?action=livres');
    }

    /**************************/
    /********* GENRES *********/
    /**************************/
    function noIcon(){
        return "no-icon.png";
    }

    function allGenre(){
        $genres = new \Projet\Models\BookModel();
        $oneGenre = $genres->allGenres();
        $genre = $oneGenre->fetchAll();
        return $this->viewAdmin("dashboard/books", $genre);
    }

    function genreAddPost($data){
        $genres = new \Projet\Models\BookModel();
        $oneGenre = $genres->genreAddPost($data);
        header('Location: indexAdmin.php?action=livres');
    }

    function genreModifyPost($data){
        $genres = new \Projet\Models\BookModel(); 
        $oneGenre = $genres->genreModifyPost($data);
       
        header('Location: indexAdmin.php?action=livres');
    }

    function deleteGenre($id){
        $genres = new \Projet\Models\BookModel();
        $oneGenre = $genres->deleteGenre($id);
        $genre = $oneGenre->fetch();
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