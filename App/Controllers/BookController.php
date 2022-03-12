<?php

namespace Projet\Controllers;

class BookController{


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
    require "App/Views/admin/dashboard/books.php";
}

function viewLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    require "App/Views/admin/dashboard/book-view.php";
}

function modifyLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    require "App/Views/admin/dashboard/book-modify.php";
}

function deleteLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    require "App/Views/admin/dashboard/book-delete.php";
}



}