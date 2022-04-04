<?php

session_start();

// autoload.php generated with composer
require_once __DIR__ . '/vendor/autoload.php';


try{

    $controllerFront = new \Projet\Controllers\FrontController();

    $bookController = new \Projet\Controllers\BookController();

    
    if (isset($_GET['action'])){
        
        if($_GET['action'] == 'livres'){
            $bookController->allBooks();
        }
        
        elseif($_GET['action'] == 'un-livre'){
            $id = $_GET['id'];
            $bookController->oneBook($id);
        }
        
        elseif($_GET['action'] == 'lieux'){
            $controllerFront->lieux();
        }

        elseif($_GET['action'] == 'about'){
            $controllerFront->about();
        }
        
        elseif($_GET['action'] == 'contact'){
            $controllerFront->contact();
        }

    }

    else{
        $bookController->home();
    }




}

catch (Exception $e){
    
    return $this->viewFront("errorLoading");
    echo $e->getMessage();
}