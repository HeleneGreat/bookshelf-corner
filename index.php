<?php

session_start();

// autoload.php generated with composer
require_once __DIR__ . '/vendor/autoload.php';

require_once('./App/form/SubmitMessage.php');


try{

    $controllerFront = new \Projet\Controllers\FrontController();

    $bookController = new \Projet\Controllers\BookController();

    $commentController = new \Projet\Controllers\CommentController();

    $messageController = new \Projet\Controllers\MsgController();

    $userController = new \Projet\Controllers\UserController();

    
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

        elseif($_GET['action'] == 'commentPost'){
            $data = [
                ':user_id' => 1,
                ':book_id' => 13,
                ':title' => htmlspecialchars(($_POST['title'])),
                ':content' => htmlspecialchars(($_POST['content']))
            ];
            $commentController->commentPost($data);
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