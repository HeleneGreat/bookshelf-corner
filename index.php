<?php

session_start();

// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';


try{

    $controllerFront = new \Projet\Controllers\FrontController();

    // Les routes (actions). Isset détermine si la variable déclarée est différente de NULL
    if (isset($_GET['action'])){

        // PAGE FORMULAIRE DE CONTACT
        if($_GET['action'] == 'contact'){
            $controllerFront->contact();
        }
        
        elseif($_GET['action'] == 'about'){
            $controllerFront->about();
        }
        
        elseif($_GET['action'] == 'livres'){
            $controllerFront->allBooks();
        }
        
        elseif($_GET['action'] == 'un-livre'){
            $id = $_GET['id'];
            $controllerFront->oneBook($id);
        }

    }
    else{
        $controllerFront->home();
    }




}

catch (Exception $e){
    require 'App/Views/front/errorLoading.php';
}