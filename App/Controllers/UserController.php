<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class UserController extends Controller{


    /*******************************************************/
    /******************* CONNECTION USER *******************/
    /*******************************************************/

    function createUser(){
        return $this->viewFront("user-create");
    }

    function createUserPost ($Post, $Files){
        $createUser = new \Projet\Models\UserModel;
        $pseudo = htmlspecialchars($Post['userPseudo']);
        $mail = htmlspecialchars($Post['userMail']);
        $pass = htmlspecialchars($Post['userMdp']);
        $mdp = password_hash($pass, PASSWORD_DEFAULT);
        $picture = $Files['picture']['name'];
        $data = [
            ':pseudo' => $pseudo,
            ':mail' => $mail,
            ':mdp' => $mdp,
        ];        
        
        if(!empty($pseudo) && (!empty($mail) && (!empty($mdp)))){
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                // create user in BDD
                $createUser->createUser($data);
                if($Files['picture']['name'] != ""){
                    // Get his ID
                    $new = new \Projet\Models\UserModel;
                    $user= $new->getId("users", "mail", $mail);                
                    $idUser = $user->fetch();
                    // Second: save his picture if there is one
                    $purpose = "user";
                    $folder = "Users";
                    $fileName = $this->verifyFiles($purpose, $folder, $idUser['id']);
                    // Third: update BDD with new picture name
                    $data = [
                        "id" => $idUser['id'],
                        "picture" => $fileName
                    ];
                    $this->updatePicture($data, 'users');
                }else{
                    header('Location: index.php?action=connexionUser&status=success&from=create');
                }
            }
        }
        else{
            $userMessage = new SubmitMessage ("error", "Les champs suivis d'une astérisque sont obligatoires ! !");
            $data["feedback"] = $userMessage->formatedMessage();
            return $this->viewFront("user-create", $data);
        }
    }

    function connexionUser(){
        $datas=[];
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                if($_GET['from'] == "create"){
                    $userMessage = new SubmitMessage ("success", "Votre compte utilisateur a bien été créé !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }
        }
        return $this->viewFront("user-connexion", $datas);
    }

    function connexionUserPost($mail, $mdp){
        // get password
        $user = new \Projet\Models\UserModel();
        $connexUser = $user->infoConnexion($mail);
        $result = $connexUser->fetch();
        $isPasswordCorrect = password_verify($mdp, $result['mdp']);
        if ($isPasswordCorrect){
            $_SESSION['id'] = $result['id'];
            $_SESSION['mail'] = $result['mail'];
            $_SESSION['mdp'] = $result['mdp'];
            $_SESSION['pseudo'] = $result['pseudo'];
            $_SESSION['picture'] = $result['picture'];
            $_SESSION['role'] = $result['role'];            
            header('Location: indexAdmin.php?action=userDashboard');
        }
        else{
            echo "Identifiants erronés !";
        }
    }

    function userDashboard(){
        $pagination = $this->pagination("comments");
        $new = new \Projet\Models\UserModel();
        $allComment = $new->allUserComments($_SESSION['id'], $pagination);
        $allComments = $allComment->fetchAll();
        $countComments = new \Projet\Models\UserModel();
        $nbrComment = $countComments->countUserComments($_SESSION['id']);
        $nbComments = $nbrComment->fetch();
        $datas = [
            'allComments' => $allComments,
            'nbComments' => $nbComments['nbComments'],
            'pages' => $pagination['pages'],
            'currentPage' => $pagination['currentPage']
        ];
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                if($_GET['from'] == "deleteComment"){
                    $userMessage = new SubmitMessage ("success", "Votre commentaire a bien été supprimé !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }
            if($_GET['status'] == "success"){
                if($_GET['from'] == "modifyComment"){
                    $userMessage = new SubmitMessage ("success", "Votre commentaire a bien été mis à jour !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }
        }
        return $this->viewUser("dashboard", $datas);
    }

    function userAccount(){
        $id = $_SESSION['id'];
        $user = new \Projet\Models\UserModel();
        $users = $user->infoUser($id);
        $datas = $users->fetch();
        return $this->viewUser("account", $datas);
    }

}