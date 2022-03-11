<?php

namespace Projet\Controllers;

class AdminController{

    function addAdmin(){
        require "App/Views/admin/createAdmin.php";
    }

    // Formulaire de création d'un compte ADMIN :
    function createAdminPost ($pseudo, $mail, $mdp){
        $createAdmin = new \Projet\Models\AdminModel($data=[]);

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $email = $createAdmin->createAdmin($pseudo, $mail, $mdp);
            require "App/Views/admin/confirmeCreation.php";
        }
        else{
            // header('Location: App/Views/admin/error.php');
            echo "bug";
        }
    }

    function connexionAdmin(){
        require "App/Views/admin/connexionAdmin.php";
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

        if ($isPasswordCorrect){
            require 'App/Views/admin/dashboard/dashboard.php';
        }
        else{
            echo "Identifiants erronés !";
        }
    }

    function livres(){
        $books = \Projet\Models\BookModel::infoBooks();
        require "App/Views/admin/dashboard/books.php";
    }

    function countLivres(){
        $books = \Projet\Models\BookModel::infoBooks();
        $count = count($books);
        return $count;
    }
    


}