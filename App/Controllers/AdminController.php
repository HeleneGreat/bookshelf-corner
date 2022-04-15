<?php

namespace Projet\Controllers;

use Projet\Forms\UserMessage;

class AdminController extends Controller{


    /********************************************************/
    /******************* CONNECTION ADMIN *******************/
    /********************************************************/
    function addAdmin(){
        return $this->viewAdmin("connexion/createAdmin");
    }

    // Formulaire de création d'un compte ADMIN :
    function createAdminPost ($pseudo, $mail, $mdp, $fileName){
        $createAdmin = new \Projet\Models\AdminModel;#($data=[]);

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $email = $createAdmin->createAdmin($pseudo, $mail, $mdp, $fileName);
            return $this->viewAdmin("connexion/confirmeCreation");
        }
        else{
            // header('Location: App/Views/admin/error.php');
            echo "bug";
        }
    }

    function connexionAdmin(){
        return $this->viewAdmin("connexion/connexionAdmin");
    }

    function connexionAdminPost($mail, $mdp){
        // récupérer le mdp
        $user = new \Projet\Models\AdminModel();
        $connexAdmin = $user->infoAdmin($mail);

        $result = $connexAdmin->fetch();

        $isPasswordCorrect = password_verify($mdp, $result['mdp']);

        $_SESSION['mail'] = $result['mail'];
        $_SESSION['mdp'] = $result['mdp'];
        $_SESSION['pseudo'] = $result['pseudo'];
        $_SESSION['picture'] = $result['picture'];

        if ($isPasswordCorrect){
            header('Location: indexAdmin.php?action=dashboard');
        }
        else{
            echo "Identifiants erronés !";
        }
    }

    /*********************************************************/
    /*********************** DASHBOARD ***********************/
    /*********************************************************/
    function dashboard(){
        $countBooks = new \Projet\Models\BookModel();
        $nbrBook = $countBooks->countBooks();
        $nbBooks = $nbrBook->fetch();
        
        $countMails = new \Projet\Models\MsgModel();
        $nbrMail = $countMails->countMessages();
        $nbMails = $nbrMail->fetch();
        $stats = array_merge($nbBooks, $nbMails);
        $this->validAccess("dashboard", $stats);
    }    

    /**********************************************************/
    /********************* ADMIN COMMENTS *********************/
    /**********************************************************/
    function comments(){
        // $comment = new \Projet\Models\AdminModel();
        // $allComments = $comment->allComments();
        // $comments = $allComments->fetchAll();
        return $this->validAccess("comments");
    }



   



    /*********************************************************/
    /********************* ADMIN ACCOUNT *********************/
    /*********************************************************/
    function infoAdmin(){
        $mail = $_SESSION['mail'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($mail);
        $infoAdmin = $admin->fetch();
        return $infoAdmin;
    }

    function account(){        
        $mail = $_SESSION['mail'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($mail);
        $infoAdmin = $admin->fetch();
        return $this->validAccess("account", $infoAdmin);
    }

    function accountModify(){
        $mail = $_SESSION['mail'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($mail);
        $infoAdmin = $admin->fetch();
        $this->validAccess("account-modify", $infoAdmin);
    }

    function accountModifyPost($data){
        $admin = new \Projet\Models\AdminModel();
        $infoAdmin = $admin->modifyAccountPost($data);
        header('Location: indexAdmin.php?action=account');
    }


    /*********************************************************/
    /******************** BLOG PARAMETERS ********************/
    /*********************************************************/
    


    function blogModifyPost($data){
        $user = new \Projet\Models\AdminModel();
        $blogs = $user->blogModifyPost($data);
        header('Location: indexAdmin.php?action=blogParameters');
    }

    function error(){
        $datas = [];
        if(isset($_GET['status'])){
            if($_GET['status'] == "error"){
                if($_GET['from'] == "no-access"){
                    $userMessage = new UserMessage ("error", "Accès non autorisé !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }
        }
        return $this->viewAdmin("error", $datas);
    }
    

}