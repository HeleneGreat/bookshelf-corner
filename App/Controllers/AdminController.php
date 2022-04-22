<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class AdminController extends Controller{


    /********************************************************/
    /******************* CONNECTION ADMIN *******************/
    /********************************************************/
    function addAdmin(){
        return $this->viewAdmin("connexion/createAdmin");
    }

    function createAdminPost ($Post, $Files){
        $createAdmin = new \Projet\Models\AdminModel;
        $pseudo = htmlspecialchars($Post['adminPseudo']);
        $mail = htmlspecialchars($Post['adminMail']);
        $pass = htmlspecialchars($Post['adminMdp']);
        $mdp = password_hash($pass, PASSWORD_DEFAULT);
        $picture = $Files['picture']['name'];
        $data = [
            ':pseudo' => $pseudo,
            ':mail' => $mail,
            ':mdp' => $mdp,
        ];
        if(!empty($pseudo) && (!empty($mail) && (!empty($mdp) && (!empty($picture))))){
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                // create admin in BDD
                $createAdmin->createAdmin($data);
                // Get his ID
                $user = new \Projet\Models\AdminModel;
                $admin = $user->getId("administrators", "mail", $mail);
                $idAdmin = $admin->fetch();
                // Second: save his picture
                $purpose = "admin";
                $folder = "Admin";
                $fileName = $this->verifyFiles($purpose, $folder, $idAdmin['id']);
                // Third: update BDD with new picture name
                $data = [
                    "id" => $idAdmin['id'],
                    "picture" => $fileName
                ];
                $this->updatePicture($data, 'administrators');
            }
        }
        else{
            $userMessage = new SubmitMessage ("error", "Tous les champs doivent être remplis !");
            $data["feedback"] = $userMessage->formatedMessage();
            return $this->viewFront("error", $data);
        }
    }

    function connexionAdmin(){
        $datas=[];
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                if($_GET['from'] == "create"){
                    $userMessage = new SubmitMessage ("success", "Le compte administrateur a bien été créé !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }
        }
        return $this->viewAdmin("connexion/connexionAdmin", $datas);
    }

    function connexionAdminPost($mail, $mdp){
        // récupérer le mdp
        $user = new \Projet\Models\AdminModel();
        $connexAdmin = $user->infoConnexion($mail);
        $result = $connexAdmin->fetch();
        $isPasswordCorrect = password_verify($mdp, $result['mdp']);
        $_SESSION['id'] = $result['id'];
        $_SESSION['mail'] = $result['mail'];
        $_SESSION['mdp'] = $result['mdp'];
        $_SESSION['pseudo'] = $result['pseudo'];
        $_SESSION['picture'] = $result['picture'];
        $_SESSION['role'] = $result['role'];
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
    function infoAdmin($id){
        // if(isset($email)){$mail = $email;} else{$mail = $_SESSION['mail'];};
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($id);
        $infoAdmin = $admin->fetch();
        return $infoAdmin;
    }

    function account(){        
        $id = $_SESSION['id'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($id);
        $infoAdmin = $admin->fetch();
        return $this->validAccess("account", $infoAdmin);
    }

    function accountModify(){
        $id = $_SESSION['id'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($id);
        $infoAdmin = $admin->fetch();
        $this->validAccess("account-modify", $infoAdmin);
    }

    function accountModifyPost($Post, $Files){
        $admin = new \Projet\Models\AdminModel();
        $id = $_SESSION['id'];
        $purpose = "admin";
        $folder = "Admin";
        if($Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $id);
        } else{
            $fileName = $this->infoAdmin($id)['picture'] ;
        }
        // Psw update
        if(!empty($Post['newAdminPsw'])){
            // Check if actual psw is correct
            $actualAdminPsw = htmlspecialchars($Post['actualAdminPsw']);
            $getInfo = $this->infoAdmin($id);    
            $isPasswordCorrect = password_verify($actualAdminPsw, $getInfo['mdp']);
            if ($isPasswordCorrect){
                $newPsw = $Post['newAdminPsw'];
                $newMdp = password_hash($newPsw, PASSWORD_DEFAULT);                    
            }
            else{
                echo "Mot de passe incorrect";
                $this->accountModify(); 
            }
        }
        // unique email
        if(!empty($Post['newMail'])){
            if($Post['newMail'] != ""){
                $newMail = $this->checkForDuplicate("administrators", htmlspecialchars($Post['newMail']));
                if($newMail == "mailOk"){
                    $adminMail = htmlspecialchars($Post['newMail']);
                }
                else{
                    $adminMail = $this->infoAdmin($id)['mail'];
                    $redirection = header('Location: indexAdmin.php?action=account&status=error&from=modifyMail');
                }
            }
        } else{
            $adminMail = $this->infoAdmin($id)['mail'];
        }
        // unique pseudo
        if(!empty($Post['newPseudo'])){
            if($Post['newPseudo'] != ""){
                $newPseudo = $this->checkForDuplicate("administrators", htmlspecialchars($Post['newPseudo']));
                if($newPseudo == "pseudoOk"){
                    $adminPseudo = htmlspecialchars($Post['newPseudo']);
                }else{
                $adminPseudo = $this->infoAdmin($id)['pseudo'];
                }
            }
        } else{
            $adminPseudo = $this->infoAdmin($id)['pseudo'];
        }
        
        // Update the $_SESSION information with this update
        $_SESSION['pseudo'] = $adminPseudo;
        $_SESSION['mail'] = $adminMail;
        $_SESSION['picture'] = $fileName;
        $_SESSION['mdp'] = $newMdp;
        // Update the DBB 
        $data = [
            ':id' => $id,
            ':picture' => $fileName,
            ':newPseudo' => $adminPseudo,
            ':newMail' => $adminMail,
            ':newAdminPsw' => $newMdp
        ];
        $admin->modifyAccountPost($data);
        header('Location: indexAdmin.php?action=account');
    }

    /**********************************************************/
    /******************** ERROR MANAGEMENT ********************/
    /**********************************************************/
    function error(){
        $datas = [];
        if(isset($_GET['status'])){
            if($_GET['status'] == "error"){
                if($_GET['from'] == "no-access"){
                    $userMessage = new SubmitMessage ("error", "Accès non autorisé !");
                    $datas["feedback"] = $userMessage->formatedMessage();
                }
            }
        }
        return $this->viewAdmin("error", $datas);
    }
    
}