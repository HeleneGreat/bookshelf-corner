<?php

session_start();

// autoload.php generated with composer
require_once __DIR__ . '/vendor/autoload.php';

require_once('./App/form/SubmitMessage.php');


try{

    $controllerFront = new \Projet\Controllers\FrontController();

    $commentController = new \Projet\Controllers\CommentController();

    $messageController = new \Projet\Controllers\MsgController();

    $userController = new \Projet\Controllers\UserController();

    
    if (isset($_GET['action'])){
        
        if($_GET['action'] == 'livres'){
            if(isset($_GET['category'])){
                $idGenre = $_GET['category'];
                $controllerFront->allBooks($idGenre);
            }else{
                $controllerFront->allBooks(0);
            }
        }
        
        elseif($_GET['action'] == 'un-livre'){
            $id = $_GET['id'];
            $controllerFront->oneBook($id);
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

        elseif($_GET['action'] == 'commentPost'){
            $id = $_GET['id'];
            $commentController->commentPost($id, $_POST);
        }

        /********************************************************/
        /********************************************************/
        /********************* USER ACCOUNT *********************/
        /********************************************************/
        /********************************************************/
        elseif($_GET['action'] == "createUser"){           
            $userController->createUser();
        }

        elseif($_GET['action'] == "createUserPost"){           
            $userController->createUserPost($_POST, $_FILES);
        }

        elseif($_GET['action'] == "connexionUser"){           
            $userController->connexionUser();
        }

        elseif ($_GET['action'] == "connexionUserPost"){
            $mail = $_POST['userMail'];
            $mdp = $_POST['userMdp'];            
            $userController->connexionUserPost($mail, $mdp);
        }

        elseif($_GET['action'] == 'error'){
            $controllerFront->error();
        }

        else{
            header('Location: index.php?error=notFound');
        }
    }

    elseif(isset($_GET['error'])){
        $controllerFront->error404();
    }

    else{
        $controllerFront->home();
    }



}

catch (Exception $e){
    // return $this->viewFront("error");
    echo $e->getMessage();
}

catch (Error $e){
    // return $this->viewFront('error');
    echo $e->getMessage();
}