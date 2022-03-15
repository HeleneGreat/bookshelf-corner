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

function modifyLivrePost($data){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->modifySingleBook($data);
    $book = $oneBook->fetch();
    header('Location: indexAdmin.php?action=livres');
}

function addLivre(){
    $books = new \Projet\Models\BookModel();
    require "App/Views/admin/dashboard/book-add.php";
}

function deleteLivre($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    require "App/Views/admin/dashboard/book-delete.php";
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
    require "App/Views/front/all-books.php";
}

function oneBook($id){
    $books = new \Projet\Models\BookModel();
    $oneBook = $books->singleBook($id);
    $book = $oneBook->fetch();
    require "App/Views/front/one-book.php";
}



}