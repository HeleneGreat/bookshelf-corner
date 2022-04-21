<?php

use Projet\Controllers\AdminController;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

require_once('./App/form/SubmitMessage.php');

try{

    $adminController = new \Projet\Controllers\AdminController();
    
    $bookController = new \Projet\Controllers\BookController();

    $blogController = new \Projet\Controllers\BlogController();

    $commentController = new \Projet\Controllers\CommentController();

    $messageController = new \Projet\Controllers\MsgController();



    if(isset($_GET['action'])){

        /********************************************************/
        /******************* CONNECTION ADMIN *******************/
        /********************************************************/
        if($_GET['action'] == 'createAccount'){
            $adminController->addAdmin();
        }

        elseif ($_GET['action'] == 'createAdminPost'){
           $adminController->createAdminPost($_POST, $_FILES);
        }

        elseif ($_GET['action'] == "connexionAdmin"){
            $adminController->connexionAdmin();
        }

        elseif ($_GET['action'] == "connexionAdminPost"){
            $mail = $_POST['adminMail'];
            $mdp = $_POST['mdp'];
            $adminController->connexionAdminPost($mail, $mdp);
        }

        elseif ($_GET['action'] == "disconnect"){
            session_destroy();
            $adminController->connexionAdmin();
        }

        /*********************************************************/
        /*********************** DASHBOARD ***********************/
        /*********************************************************/
        elseif($_GET['action'] == 'dashboard'){
            $adminController->dashboard();
        }

        /*********************************************************/
        /********************** PAGE LIVRES **********************/
        /*********************************************************/

        /****************************/
        /******** TAB LIVRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres'){
            $bookController->livresAll();
        }

        elseif ($_GET['action'] == "livresview"){
            $id = $_GET['id'];
            $bookController->viewLivre($id);
        }
        
        elseif ($_GET['action'] == "livresadd"){
            $bookController->addLivre();
        }

        elseif ($_GET['action'] == "livresaddPost"){
            $newBook = $bookController->addLivrePost($_POST, $_FILES);
        }

        elseif ($_GET['action'] == "livresmodify"){
            $id = $_GET['id'];
            $bookController->modifyLivre($id);
        }

        elseif ($_GET['action'] == "livresmodifyPost"){
            $id = $_GET['id'];            
            $bookController->modifyLivrePost($id, $_POST, $_FILES);
        }  

        elseif ($_GET['action'] == "livresdelete"){
            $id = $_GET['id'];
            $bookController->deleteLivre($id);
        }

        /****************************/
        /******** TAB GENRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres-genres'){
            $bookController->livresGenres();
        }

        elseif ($_GET['action'] == "genreAddPost"){
            $bookController->genreAddPost($_POST, $_FILES);
        }

        elseif ($_GET['action'] == "genreModifyPost"){
            $id = $_GET['id'];
            $bookController->genreModifyPost($id, $_POST, $_FILES);
            // unique name
            // if(!empty($_POST['newType'])){
            //     $newName = $bookController->checkForDuplicate("genres", htmlspecialchars( $_POST['newType']));
            //     if($newName == false){
            //         $genreName = htmlspecialchars( $_POST['newType']);
            //     }
            //     else{ 
            //         $bookController->livresGenres();
            //        }
            // } else{
            //     $genreName = $bookController->infoGenre($id)['category'];
            // }
            // Données issues du formulaire
            
        }  

        elseif ($_GET['action'] == "genreDelete"){
            $id = $_GET['id'];
            $bookController->deleteGenre($id);
        }

        /****************************/
        /******** TAB SLIDER ********/
        /****************************/
        elseif($_GET['action'] == 'livres-slider'){
            $bookController->livresSlider();
        }

        elseif($_GET['action'] == "sliderModifyPost"){
            $bookController->sliderSelection($_POST);
        }
        
        /********************************************************/
        /*********************** MESSAGES ***********************/
        /********************************************************/
        elseif($_GET['action'] == "messages"){
            $messageController->allMessages();
        }

        elseif($_GET['action'] == "messageView"){
            $id = $_GET['id'];
            $messageController->viewMessage($id);
        }   

        elseif ($_GET['action'] == "messageDelete"){
            $id = $_GET['id'];
            $messageController->deleteMessage($id);
        }

        /*********************************************************/
        /********************* ADMIN ACCOUNT *********************/
        /*********************************************************/
        elseif($_GET['action'] == "account"){
            $adminController->account();
        }

        elseif($_GET['action'] == "accountModify"){
            $adminController->accountModify();
        }

        elseif($_GET['action'] == "accountModifyPost"){
            $adminController->accountModifyPost($_POST, $_FILES);
        }
        
        /*********************************************************/
        /******************** BLOG PARAMETERS ********************/
        /*********************************************************/
        elseif($_GET['action'] == "blogParameters"){
            $id = "1";
            $blogController->blogParameters($id);
        }

        elseif($_GET['action'] == "blogModify"){
            $id = "1";
            $blogController->blogModify($id);
        }

        elseif($_GET['action'] == "blogModifyPost"){
            $id = "1";            
            $blogController->blogModifyPost($id, $_POST, $_FILES);
        }
   
        /********************************************************/
        /*********************** COMMENTS ***********************/
        /********************************************************/
        elseif($_GET['action'] == "comments"){
            $commentController->allComments();
        }   

        elseif($_GET['action'] == "error"){
            $adminController->error();
        }
    }   

    else{
        $adminController->connexionAdmin();
    }
}

catch (Exception $e){
    // TODO : message d'erreur
    // return $this->viewAdmin("error");
    echo $e->getMessage();
}

catch (Error $e){
    // TODO : add message d'erreur
    // return $this->validAccess('error');
    echo $e->getMessage();
}