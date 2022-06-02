<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class AdminController extends Controller
{


    /********************************************************/
    /******************* CONNECTION ADMIN *******************/
    /********************************************************/
    function addAdmin()
    {
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
        } else {
            $userMessage = new SubmitMessage("error", "Tous les champs doivent être remplis !");
            $data["feedback"] = $userMessage->formatedMessage();
            return $this->viewFront("error", $data);
        }
    }

    function connexionAdmin()
    {
        $datas=[];
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->accountMessage();
        }
        return $this->viewAdmin("connexion/connexionAdmin", $datas);
    }

    function connexionAdminPost($mail, $mdp)
    {
        // get password
        $user = new \Projet\Models\AdminModel();
        $connexAdmin = $user->infoConnexion($mail);
        $result = $connexAdmin->fetch();
        if(!empty($result)){
            $isPasswordCorrect = password_verify($mdp, $result['mdp']);
            if ($isPasswordCorrect){
                $_SESSION['id'] = $result['id'];
                $_SESSION['mail'] = $result['mail'];
                $_SESSION['mdp'] = $result['mdp'];
                $_SESSION['pseudo'] = $result['pseudo'];
                $_SESSION['picture'] = $result['picture'];
                $_SESSION['role'] = $result['role'];
                header('Location: indexAdmin.php?action=dashboard');
            }
            else{
                header('Location: indexAdmin.php?action=connexionAdmin&status=error&from=connexionPsw');
            }
        }else{
            header('Location: indexAdmin.php?action=connexionAdmin&status=error&from=connexionMail');
        }
    }

    /*********************************************************/
    /*********************** DASHBOARD ***********************/
    /*********************************************************/
    function dashboard() {
        $countBooks = new \Projet\Models\BookModel();
        $nbBooks = $countBooks->countBooks();
        $lastBooks = $countBooks->allBooks();
        $lastBook = $lastBooks->fetch();
        $countMails = new \Projet\Models\MsgModel();
        $nbMails = $countMails->countMessages();
        $lastMails = $countMails->allMessages();
        $lastMail = $lastMails->fetch();
        $countComments = new \Projet\Models\CommentModel();
        $nbComments = $countComments->countComments();
        $lastComments = $countComments->allComments();
        $lastComment = $lastComments->fetch();
        $countUsers = new \Projet\Models\UserModel();
        $nbUsers = $countUsers->countUsers();
        $lastUsers = $countUsers->allUsers();
        $lastUser = $lastUsers->fetch();
        $datas = [
            'nbBooks' => $nbBooks[0],
            'lastBook' => $lastBook,
            'nbMails' => $nbMails[0],
            'lastMail' => $lastMail,
            'nbComments' => $nbComments[0],
            'lastComment' => $lastComment,
            'nbUsers' => $nbUsers[0],
            'lastUser' => $lastUser];
        return $this->validAccess("dashboard", $datas);
    }    

    /*********************************************************/
    /********************* ADMIN ACCOUNT *********************/
    /*********************************************************/
    function infoAdmin($id)
    {
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($id);
        $infoAdmin = $admin->fetch();
        return $infoAdmin;
    }

    function account()
    {
        $id = $_SESSION['id'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($id);
        $datas = $admin->fetch();
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->modifyAccountMessage();
        }
        return $this->validAccess("account", $datas);
    }

    function accountModify()
    {
        $id = $_SESSION['id'];
        if($_SESSION['role'] > 0){
            $new = new \Projet\Models\AdminModel();
            $admin = $new->infoAdmin($id);
            $infoAdmin = $admin->fetch();
            $this->validAccess("account-modify", $infoAdmin);
        }else{
            $new = new \Projet\Models\UserModel();
            $user = $new->infoUser($id);
            $infoUser = $user->fetch();
            $this->viewUser("account-modify", $infoUser);
        }
    }

    function accountModifyPost($id, $Post, $Files)
    {
        $admin = new \Projet\Models\AdminModel();
        $purpose = "admin";
        $folder = "Admin";
        $redirection = null;
        // Picture update
        ($Files['picture']['name'] !== "") ? $fileName = $this->verifyFiles($purpose, $folder, $id) : $fileName = $this->infoAdmin($id)['picture'] ;
        // Psw update
        if(!empty($Post['newPsw']) || $Post['newPsw'] != ""){
            // Check if actual psw is correct
            $actualAdminPsw = htmlspecialchars($Post['actualPsw']);
            $getInfo = $this->infoAdmin($id);    
            $isPasswordCorrect = password_verify($actualAdminPsw, $getInfo['mdp']);
            if ($isPasswordCorrect == true){
                $newPsw = $Post['newPsw'];
                $newMdp = password_hash($newPsw, PASSWORD_DEFAULT);                    
            }
            else{
                header('Location: indexAdmin.php?action=account&status=error&from=modifyPsw');
                return;
            }
        }else{
            $newMdp = $this->infoAdmin($id)['mdp'];
        }
        // unique email
        if(!empty($Post['newMail']) || $Post['newMail'] != ""){
            if($Post['newMail'] != $_SESSION['mail']){
                $newMail = $this->checkForDuplicate("administrators", htmlspecialchars($Post['newMail']));
                if($newMail == "nameOk"){
                    $adminMail = htmlspecialchars($Post['newMail']);
                }else{
                    $adminMail = $this->infoAdmin($id)['mail'];
                    $redirection = "pbMail";
                }
            }else{
                $adminMail = $this->infoAdmin($id)['mail'];
            }
        }else{
            $adminMail = $this->infoAdmin($id)['mail'];
        }
        // unique pseudo
        if(!empty($Post['newPseudo']) || $Post['newPseudo'] != ""){
            if($Post['newPseudo'] != $_SESSION['pseudo']){
                $newPseudo = $this->checkForDuplicate("administrators", htmlspecialchars($Post['newPseudo']));
                if($newPseudo == "nameOk"){
                    $adminPseudo = htmlspecialchars($Post['newPseudo']);
                }else{
                    $adminPseudo = $this->infoAdmin($id)['pseudo'];
                    $redirection .= "pbPseudo";
                }
            }else{
                $adminPseudo = $_SESSION['pseudo'];
            }
        }else{
            $adminPseudo = $this->infoAdmin($id)['pseudo'];
        }
        // Update the $_SESSION information with this update
        if($redirection == null || !str_contains($redirection != null, "pbPseudo")){
            $_SESSION['pseudo'] = $adminPseudo;
        }
        if($redirection == null || !str_contains($redirection, "pbMail")){
            $_SESSION['mail'] = $adminMail;
        }        
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
        if (!isset($redirection)){
            header('Location: indexAdmin.php?action=account&status=success&from=modify');
        }elseif ($redirection == "pbMail"){
            header('Location: indexAdmin.php?action=account&status=error&from=modifyMail');
        }elseif ($redirection == "pbPseudo"){
            header('Location: indexAdmin.php?action=account&status=error&from=modifyPseudo');
        }elseif ($redirection == "pbMailpbPseudo"){
            header('Location: indexAdmin.php?action=account&status=error&from=modifyMailPseudo');
        }
    }

    /**********************************************************/
    /******************** ERROR MANAGEMENT ********************/
    /**********************************************************/
    function error()
    {
        $datas = [];
        if(isset($_GET['status'])){
            if($_GET['from'] == "no-access"){
                $userMessage = new SubmitMessage("error", "Accès non autorisé !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
        }
        return $this->viewAdmin("error", $datas);
    }

   

}