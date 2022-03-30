<?php

namespace Projet\Controllers;

class AdminController extends Controller{


/********************************************************/
/******************* CONNECTION ADMIN *******************/
/********************************************************/
    function addAdmin(){
        return $this->viewAdmin("createAdmin");
    }

    // Formulaire de création d'un compte ADMIN :
    function createAdminPost ($pseudo, $mail, $mdp, $fileName){
        $createAdmin = new \Projet\Models\AdminModel;#($data=[]);

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $email = $createAdmin->createAdmin($pseudo, $mail, $mdp, $fileName);
            return $this->viewAdmin("confirmeCreation");
        }
        else{
            // header('Location: App/Views/admin/error.php');
            echo "bug";
        }
    }

    function connexionAdmin(){
        return $this->viewAdmin("connexionAdmin");
    }

    // Formulaire de connection admin
    function connexionAdminPost($mail, $mdp){

        // récupérer le mdp
        $user = new \Projet\Models\AdminModel();
        $connexAdmin = $user->recupMdp($mail, $mdp);

        $result = $connexAdmin->fetch();

        $isPasswordCorrect = password_verify($mdp, $result['mdp']);

        $_SESSION['mail'] = $result['mail'];
        $_SESSION['mdp'] = $result['mdp'];
        $_SESSION['pseudo'] = $result['pseudo'];
        $_SESSION['picture'] = $result['picture'];

        $countBooks = new \Projet\Models\BookModel();
        $nbrBook = $countBooks->countBooks();
        $nbBooks = $nbrBook->fetch();

        if ($isPasswordCorrect){
            return $this->viewAdmin("dashboard/dashboard", $nbBooks);
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
        return $this->viewAdmin("dashboard/dashboard", $nbBooks);
    }    

    /*********************************************************/
    /********************* ADMIN ACCOUNT *********************/
    /*********************************************************/
    function account(){
        $mail = $_SESSION['mail'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->recupMdp($mail);
        $infoAdmin = $admin->fetch();
        return $this->viewAdmin("dashboard/account", $infoAdmin);
    }

    function accountModify(){
        $mail = $_SESSION['mail'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->recupMdp($mail);
        $infoAdmin = $admin->fetch();
        return $this->viewAdmin("dashboard/account-modify", $infoAdmin);
    }

    function accountModifyPost($data){
        $admin = new \Projet\Models\AdminModel();
        $infoAdmin = $admin->modifyAccountPost($data);
        header('Location: indexAdmin.php?action=account');
    }


    /*********************************************************/
    /******************** BLOG PARAMETERS ********************/
    /*********************************************************/
    function infoBlog($id){
        $user = new \Projet\Models\AdminModel();
        $blogs = $user->infoBlog($id);
        $blog = $blogs->fetch();
        return $this->viewAdmin("dashboard/parameters", $blog);
    }

    function blogModify($id){
        $user = new \Projet\Models\AdminModel();
        $blogs = $user->infoBlog($id);
        $blog = $blogs->fetch();
        return $this->viewAdmin("dashboard/parameters-modify", $blog);
    }

    function blogModifyPost($data){
        $user = new \Projet\Models\AdminModel();
        $blogs = $user->blogModifyPost($data);
        return $this->viewAdmin("dashboad/dashboard");
    }



}