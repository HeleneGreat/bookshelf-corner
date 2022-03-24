<?php

namespace Projet\Controllers;

class FrontController extends Controller{
    function home(){

        // $homeFront = new \Projet\Models\FrontModel();
        // $accueil = $homeFront->viewFront();

        return $this->viewFront("home");
    }

    function contact(){
        return $this->viewFront("contact");
    }

    function about(){
        return $this->viewFront("about");
    }

    function lieux(){
        return $this->viewFront("lieux");
    }

 


}