<?php

session_start();

// autoload.php generated with composer
require_once __DIR__ . '/vendor/autoload.php';

require_once('./App/form/SubmitMessage.php');


try{

    $controllerFront = new \Projet\Controllers\FrontController();

    $bookController = new \Projet\Controllers\BookController();

    $messageController = new \Projet\Controllers\MsgController();

    
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
        
        elseif($_GET['action'] == 'contactPost'){
            $data = [
                ':gender' => htmlspecialchars($_POST['gender']),
                ':familyname' => htmlspecialchars($_POST['familyname']),
                ':firstname' => htmlspecialchars($_POST['firstname']),
                ':email' => htmlspecialchars($_POST['email']),
                ':object' => htmlspecialchars($_POST['object']),
                ':message' => htmlspecialchars($_POST['message'])
            ];
            $messageController->contactPost($data);
        }

    }

    else{
        $bookController->home();
    }




}

catch (Exception $e){
    // return $this->viewFront("error");
    echo $e->getMessage();
}

catch (Error $e){
    return $this->viewFront('error');
}