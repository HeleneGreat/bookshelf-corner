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

    function lieux(){
        require 'App/Views/front/lieux.php';
    }

 


}