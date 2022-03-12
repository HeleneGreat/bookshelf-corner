<?php

use Projet\Controllers\AdminController;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try{

    $adminController = new \Projet\Controllers\AdminController();

    if(isset($_GET['action'])){

    /********************************************************/
    /******************* CONNECTION ADMIN *******************/
    /********************************************************/
        // Lien vers le formulaire de création d'un nouvel admin
        if($_GET['action'] == 'createAccount'){
            $adminController->addAdmin();
        }

        // Contrôle de ce formulaire de création
        elseif ($_GET['action'] == 'createAdminPost'){
            $pseudo = htmlspecialchars($_POST['adminPseudo']);
            $mail = htmlspecialchars($_POST['adminMail']);
            $pass = htmlspecialchars($_POST['adminMdp']);
            $mdp = password_hash($pass, PASSWORD_DEFAULT);

            if(!empty($pseudo) && (!empty($mail) && (!empty($mdp) ))){
                // echo "les champs sont bien remplis";
                $adminController->createAdminPost($pseudo, $mail, $mdp);
            }
            else{
                echo "non non il manque des champs";
                // throw new Exception('Tous les champs ne sont pas remplis');
            }
        }

        // Se connecter en tant qu'admin
        elseif ($_GET['action'] == "connexionAdmin"){
            $adminController->connexionAdmin();
        }

        // Contrôle du formulaire de connection
        elseif ($_GET['action'] == "connexionAdminPost"){
            $mail = $_POST['adminMail'];
            $mdp = $_POST['mdp'];

            $adminController->connexionAdminPost($mail, $mdp);
        }

        // Se déconnecter
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
        elseif($_GET['action'] == 'livres'){
            $adminController->livres();
        }

        elseif ($_GET['action'] == "view"){
            $id = $_GET['id'];
            $adminController->viewLivre($id);
        }

        elseif ($_GET['action'] == "modify"){
            $id = $_GET['id'];
            $adminController->modifyLivre($id);
        }

        elseif ($_GET['action'] == "delete"){
            $id = $_GET['id'];
            $adminController->deleteLivre($id);
        }





    }
    else{
        $adminController->connexionAdmin();
    }
}

catch (Exception $e){
    // require 'App/Views/admin/error.php';
    echo "erreur catch de l'indexAdmin";
}