<?php

namespace Projet\Controllers;

class FrontController{
    function home(){

        // $homeFront = new \Projet\Models\FrontModel();
        // $accueil = $homeFront->viewFront();

        require 'App/Views/front/home.php';
    }

    function contact(){
        require 'App/Views/front/contact.php';
    }

    function about(){
        require 'App/Views/front/about.php';
    }

    function allBooks(){
        $books = \Projet\Models\BookModel::infoBooks();
        require "App/Views/front/all-books.php";
    }

    function oneBook($id){
        $books = \Projet\Models\BookModel::infoBooks();
        require "App/Views/front/one-book.php";
    }




}