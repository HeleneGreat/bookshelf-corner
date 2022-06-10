<?php

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

        /*******************************************************/
        /*******************************************************/
        /******************** ADMIN ACCOUNT ********************/
        /*******************************************************/
        /*******************************************************/
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

        /***************************************************/
        /******************** DASHBOARD ********************/
        /***************************************************/
        elseif($_GET['action'] == 'dashboard')
        {
            $adminController->dashboard();
        }

        /****************************************************/
        /********************** LIVRES **********************/
        /****************************************************/

        /****************************/
        /******** TAB LIVRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres')
        {
            $bookController->livresAll();
        }

        elseif ($_GET['action'] == "livresview")
        {
            $bookId = $_GET['id'];
            if($bookId != null){
                $bookController->viewLivre($bookId);
            }else{
                header('Location: indexAdmin.php?action=livres');
            }
        }
        
        elseif ($_GET['action'] == "livresadd")
        {
            $bookController->addLivre();
        }

        elseif ($_GET['action'] == "livresaddPost")
        {
            $adminId = strval($_SESSION['id']);
            $newBook = $bookController->addLivrePost($_POST, $_FILES, $adminId);
        }

        elseif ($_GET['action'] == "livresmodify")
        {
            $bookId = $_GET['id'];
            if($bookId != null){
                $bookController->modifyLivre($bookId);
            }else{
                header('Location: indexAdmin.php?action=livres');
            }
        }

        elseif ($_GET['action'] == "livresmodifyPost")
        {
            $bookId = $_GET['id'];            
            $bookController->modifyLivrePost($bookId, $_POST, $_FILES);
        }  

        elseif ($_GET['action'] == "livresdelete")
        {
            $bookId = $_GET['id'];
            if($bookId != null){
                $commentController->deleteBookComments($bookId);
                $bookController->deleteLivre($bookId);
            }else{
                header('Location: indexAdmin.php?action=livres');
            }
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
            $genreId = $_GET['id'];
            if($genreId != 21){
                $genreController->genreModifyPost($genreId, $_POST, $_FILES);
            }else{
                header('Location: indexAdmin.php?action=livres-genres');
            }
        }  

        elseif ($_GET['action'] == "genreDelete")
        {
            $genreId = $_GET['id'];
            if($genreId != 21){
                $genreController->deleteGenre($genreId);
            }else{
                header('Location: indexAdmin.php?action=livres-genres');
            }
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
            $messageId = $_GET['id'];
            if($messageId != null){
                $messageController->viewMessage($messageId);
            }else{
                header('Location: indexAdmin.php?action=messages');
            }
        }   

        elseif ($_GET['action'] == "messagesDelete")
        {
            $messageId = $_GET['id'];
            if($messageId != null){
                $messageController->deleteMessage($messageId);
            }else{
                header('Location: indexAdmin.php?action=messages');
            }
        }

        /********************************************************/
        /*********************** COMMENTS ***********************/
        /********************************************************/
        elseif($_GET['action'] == "comments")
        {
            if($_SESSION['role'] > 0)
            {
                $commentController->allComments();
            }else{
                header('Location: indexAdmin.php?action=error&status=error&from=no-access');
            }
        }

        elseif($_GET['action'] == "comments-mine")
        {
            if($_SESSION['role'] >= 0)
            {
                $commentController->accountComments();
            }else{
                header('Location: indexAdmin.php?action=error&status=error&from=no-access');
            }
        }

        elseif($_GET['action'] == "commentsView")
        {
            $commentId = $_GET['id'];
            if($commentId != null){
                $commentController->viewComment($commentId);
            }else{
                header('Location: indexAdmin.php?action=comments');
            }
        }

        elseif ($_GET['action'] == "commentModify")
        {
            $commentId = $_GET['id'];
            if($commentId != null){
                $commentController->commentModify($commentId);
            }else{
                header('Location: indexAdmin.php?action=comments');
            }
        }

        elseif ($_GET['action'] == "commentModifyPost")
        {
            $commentId = $_GET['id'];
            $commentController->commentModifyPost($commentId, $_POST);
        }

        elseif ($_GET['action'] == "commentsDelete")
        {
            $commentId = $_GET['id'];
            if($commentId != null){
                $commentController->deleteUserComment($commentId);
            }else{
                header('Location: indexAdmin.php?action=comments');
            }
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
            $adminId = $_GET['id'];
            $adminController->accountModifyPost($adminId, $_POST, $_FILES);
        }
        
        /*********************************************************/
        /******************** BLOG PARAMETERS ********************/
        /*********************************************************/
        elseif($_GET['action'] == "blogParameters")
        {
            $blogId = "1";
            $blogController->blogParameters($blogId);
        }

        elseif($_GET['action'] == "blogModify")
        {
            $blogId = "1";
            $blogController->blogModify($blogId);
        }

        elseif($_GET['action'] == "blogModifyPost")
        {
            $blogId = "1";            
            $blogController->blogModifyPost($blogId, $_POST, $_FILES);
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

        elseif ($_GET['action'] == "commentDelete")
        {
            $commentId = $_GET['id'];
            if($commentId != null){
                $commentController->deleteComment($commentId);
            }else{
                header('Location: indexAdmin.php?action=comments-mine');
            }
        }

        elseif($_GET['action'] == "userAccount")
        {
            $userController->userAccount();
        }

        elseif($_GET['action'] == "userAccountModifyPost")
        {
            $uderId = $_GET['id'];
            $userController->userAccountModifyPost($uderId, $_POST, $_FILES);
        }

        elseif ($_GET['action'] == "userDisconnect")
        {
            session_destroy();
            $userController->connexionUser();
        }

        /********************************************************/
        /********************************************************/
        /******************* ERROR MANAGEMENT *******************/
        /********************************************************/
        /********************************************************/
        elseif($_GET['action'] == "error")
        {
            $adminController->error();
        }

        else
        {
            $adminController->error404();
        }
    }

    elseif(isset($_GET['error']))
    {
        $adminController->error404();
    }

    else
    {
        if(!empty($_SESSION)){
            if($_SESSION['role'] > 0){
                header('Location: indexAdmin.php?action=dashboard');
            }else{
                header('Location: indexAdmin.php?action=userDashboard');
            }
        }else{
            header('Location: indexAdmin.php?action=connexionAdmin');
        }
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