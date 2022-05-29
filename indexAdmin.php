<?php

// TODO : à supprimer ?
use Projet\Controllers\AdminController;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

require_once('./App/form/SubmitMessage.php');

try
{

    $adminController = new \Projet\Controllers\AdminController();

    $userController = new \Projet\Controllers\UserController();
    
    $bookController = new \Projet\Controllers\BookController();

    $genreController = new \Projet\Controllers\GenreController();

    $blogController = new \Projet\Controllers\BlogController();

    $commentController = new \Projet\Controllers\CommentController();

    $messageController = new \Projet\Controllers\MsgController();



    if(isset($_GET['action']))
    {

        /********************************************************/
        /******************* CONNECTION ADMIN *******************/
        /********************************************************/
        if($_GET['action'] == 'createAccount')
        {
            $adminController->addAdmin();
        }

        elseif ($_GET['action'] == 'createAdminPost')
        {
           $adminController->createAdminPost($_POST, $_FILES);
        }

        elseif ($_GET['action'] == "connexionAdmin")
        {
            $adminController->connexionAdmin();
        }

        elseif ($_GET['action'] == "connexionAdminPost")
        {
            $mail = $_POST['adminMail'];
            $mdp = $_POST['mdp'];
            $adminController->connexionAdminPost($mail, $mdp);
        }

        elseif ($_GET['action'] == "disconnect")
        {
            session_destroy();
            $adminController->connexionAdmin();
        }

        /*********************************************************/
        /*********************** DASHBOARD ***********************/
        /*********************************************************/
        elseif($_GET['action'] == 'dashboard')
        {
            $adminController->dashboard();
        }

        /*********************************************************/
        /********************** PAGE LIVRES **********************/
        /*********************************************************/

        /****************************/
        /******** TAB LIVRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres')
        {
            $bookController->livresAll();
        }

        elseif ($_GET['action'] == "livresview")
        {
            $id = $_GET['id'];
            $bookController->viewLivre($id);
        }
        
        elseif ($_GET['action'] == "livresadd")
        {
            $bookController->addLivre();
        }

        elseif ($_GET['action'] == "livresaddPost")
        {
            $admin = strval($_SESSION['id']);
            $newBook = $bookController->addLivrePost($_POST, $_FILES, $admin);
        }

        elseif ($_GET['action'] == "livresmodify")
        {
            $id = $_GET['id'];
            $bookController->modifyLivre($id);
        }

        elseif ($_GET['action'] == "livresmodifyPost")
        {
            $id = $_GET['id'];            
            $bookController->modifyLivrePost($id, $_POST, $_FILES);
        }  

        elseif ($_GET['action'] == "livresdelete")
        {
            $id = $_GET['id'];
            $bookController->deleteLivre($id);
        }

        /****************************/
        /******** TAB GENRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres-genres')
        {
            $genreController->livresGenres();
        }

        elseif ($_GET['action'] == "genreAddPost")
        {
            $genreController->genreAddPost($_POST, $_FILES);
        }

        elseif ($_GET['action'] == "genreModifyPost")
        {
            $id = $_GET['id'];
            $genreController->genreModifyPost($id, $_POST, $_FILES);
        }  

        elseif ($_GET['action'] == "genreDelete")
        {
            $id = $_GET['id'];
            $genreController->deleteGenre($id);
        }

        /****************************/
        /******** TAB SLIDER ********/
        /****************************/
        elseif($_GET['action'] == 'livres-slider')
        {
            $bookController->livresSlider();
        }

        elseif($_GET['action'] == "sliderModifyPost")
        {
            $bookController->sliderSelection($_POST);
        }
        
        /********************************************************/
        /*********************** MESSAGES ***********************/
        /********************************************************/
        elseif($_GET['action'] == "messages")
        {
            $messageController->allMessages();
        }

        elseif($_GET['action'] == "messagesView")
        {
            $id = $_GET['id'];
            $messageController->viewMessage($id);
        }   

        elseif ($_GET['action'] == "messagesDelete")
        {
            $id = $_GET['id'];
            $messageController->deleteMessage($id);
        }

        /********************************************************/
        /*********************** COMMENTS ***********************/
        /********************************************************/
        elseif($_GET['action'] == "comments")
        {
            // if($_SESSION['role'] > 0){
            //     $commentController->allComments();
            // }else{
                $commentController->accountComments();

            // }
        }

        elseif($_GET['action'] == "comments-mine")
        {
            $commentController->accountComments();
        }

        elseif($_GET['action'] == "commentsView")
        {
            $id = $_GET['id'];
            $commentController->viewComment($id);
        }

        elseif ($_GET['action'] == "commentModify")
        {
            $id = $_GET['id'];
            $commentController->commentModify($id);
        }

        elseif ($_GET['action'] == "commentsDelete")
        {
            $id = $_GET['id'];
            $commentController->deleteUserComment($id);
        }

        /*********************************************************/
        /********************* ADMIN ACCOUNT *********************/
        /*********************************************************/
        elseif($_GET['action'] == "account")
        {
            $adminController->account();
        }

        elseif($_GET['action'] == "accountModify")
        {
            $adminController->accountModify();
        }

        elseif($_GET['action'] == "accountModifyPost")
        {
            $id = $_GET['id'];
            $adminController->accountModifyPost($id, $_POST, $_FILES);
        }
        
        /*********************************************************/
        /******************** BLOG PARAMETERS ********************/
        /*********************************************************/
        elseif($_GET['action'] == "blogParameters")
        {
            $id = "1";
            $blogController->blogParameters($id);
        }

        elseif($_GET['action'] == "blogModify")
        {
            $id = "1";
            $blogController->blogModify($id);
        }

        elseif($_GET['action'] == "blogModifyPost")
        {
            $id = "1";            
            $blogController->blogModifyPost($id, $_POST, $_FILES);
        }
        
        /********************************************************/
        /********************************************************/
        /********************* USER ACCOUNT *********************/
        /********************************************************/
        /********************************************************/
        elseif ($_GET['action'] == "userDashboard")
        {
            $userController->userDashboard();
        }

        elseif ($_GET['action'] == "commentModifyPost")
        {
            $id = $_GET['id'];
            $commentController->commentModifyPost($id, $_POST);
        }

        elseif($_GET['action'] == "userAccountModifyPost")
        {
            $id = $_GET['id'];
            $userController->userAccountModifyPost($id, $_POST, $_FILES);
        }

        elseif ($_GET['action'] == "commentDelete")
        {
            $id = $_GET['id'];
            $commentController->deleteComment($id);
        }

        elseif($_GET['action'] == "userAccount")
        {
            $userController->userAccount();
        }

        elseif ($_GET['action'] == "userDisconnect")
        {
            session_destroy();
            $userController->connexionUser();
        }

        elseif($_GET['action'] == "error")
        {
            $adminController->error();
        }

        else
        {
            header('Location: indexAdmin.php?error=notFound');
        }
    }

    elseif(isset($_GET['error']))
    {
        $adminController->error404();
    }

    else
    {
        $adminController->connexionAdmin();
    }
}

catch (Exception $e)
{
    // TODO : message d'erreur
    // return $this->viewAdmin("error");
    echo $e->getMessage();
}

catch (Error $e)
{
    // TODO : add message d'erreur
    // return $this->validAccess('error');
    echo $e->getMessage();
}