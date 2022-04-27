<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

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

    function error(){
        if(isset($_GET['status'])){
            if($_GET['status'] == "error"){
                if($_GET['from'] == "no-user-account"){
                    $userMessage = new SubmitMessage ("error", "Vous devez être connecté pour accéder à cet espace !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }   
        }
        return $this->viewFront("error", $datas);
    }

 


}