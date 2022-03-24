<?php

session_start();

// autoload.php généré avec composer
require_once __DIR__ . '/vendor/autoload.php';


try{

    $controllerFront = new \Projet\Controllers\FrontController();

    $bookController = new \Projet\Controllers\BookController();

    // Les routes (actions). Isset détermine si la variable déclarée est différente de NULL
    if (isset($_GET['action'])){

        // PAGE FORMULAIRE DE CONTACT
        if($_GET['action'] == 'contact'){
            $controllerFront->contact();
        }
        
        elseif($_GET['action'] == 'about'){
            $controllerFront->about();
        }
        
        elseif($_GET['action'] == 'lieux'){
            $controllerFront->lieux();
        }
        
        elseif($_GET['action'] == 'livres'){
            $bookController->allBooks();
        }
        
        elseif($_GET['action'] == 'un-livre'){
            $id = $_GET['id'];
            $bookController->oneBook($id);
        }

    }
    else{
        $controllerFront->home();
    }




}

catch (Exception $e){
    
    return $this->viewFront("errorLoading");
}