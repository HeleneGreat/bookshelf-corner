<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class UserController extends Controller
{
    /*******************************************************/
    /******************* CONNECTION USER *******************/
    /*******************************************************/

    function createUser()
    {
        return $this->viewFront("user-create");
    }

    function createUserPost ($Post, $Files)
    {
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
        if(!empty($pseudo) && (!empty($mail) && (!empty($mdp))))
        {
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

    function connexionUser()
    {
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

    function connexionUserPost($mail, $mdp)
    {
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

    /****************************************************/
    /******************* USER ACCOUNT *******************/
    /****************************************************/
    function userDashboard()
    {
        $countComments = new \Projet\Models\UserModel();
        $nbrComment = $countComments->countUserComments($_SESSION['id']);
        $nbComments = $nbrComment->fetch();
        $userId = "WHERE user_id = " . $_SESSION['id'];
        $lastComments = new \Projet\Models\CommentModel();
        $lastComment = $lastComments->allComments($userId);
        $userLastComment = $lastComment->fetch();
        $datas = [
            'nbComments' => $nbComments['nbComments'],
            'lastComment' => $userLastComment
        ];
        return $this->viewUser("dashboard", $datas);
    }

    function infoUser($id)
    {
        $new = new \Projet\Models\UserModel();
        $user = $new->infoUser($id);
        $infoUser = $user->fetch();
        return $infoUser;
    }

    function userAccount()
    {
        $id = $_SESSION['id'];
        $user = new \Projet\Models\UserModel();
        $users = $user->infoUser($id);
        $datas = $users->fetch();
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->modifyAccountMessage();
        }
        return $this->viewUser("account", $datas);
    }

    // Modify User account
    function userAccountModifyPost($id, $Post, $Files)
    {
        $user = new \Projet\Models\UserModel();
        $purpose = "user";
        $folder = "Users";
        $redirection = null;
        // Picture update
        ($Files['picture']['name'] !== "") ? $fileName = $this->verifyFiles($purpose, $folder, $id) : $fileName = $this->infoUser($id)['picture'] ;
        // Psw update
        if(!empty($Post['newPsw']) || $Post['newPsw'] != ""){
            // Check if actual psw is correct
            $actualUserPsw = htmlspecialchars($Post['actualPsw']);
            $getInfo = $this->infoUser($id);    
            $isPasswordCorrect = password_verify($actualUserPsw, $getInfo['mdp']);
            if ($isPasswordCorrect == true){
                $newPsw = $Post['newPsw'];
                $newMdp = password_hash($newPsw, PASSWORD_DEFAULT);                    
            }
            else{
                header('Location: indexAdmin.php?action=userAccount&status=error&from=modifyPsw');
                return;
            }
        }else{
            $newMdp = $this->infoUser($id)['mdp'];
        }
        // unique email
        if(!empty($Post['newMail']) || $Post['newMail'] != ""){
            if($Post['newMail'] != $_SESSION['mail']){
                $newMail = $this->checkForDuplicate("users", htmlspecialchars($Post['newMail']));
                if($newMail == "nameOk"){
                    $userMail = htmlspecialchars($Post['newMail']);
                }else{
                    $userMail = $this->infoUser($id)['mail'];
                    $redirection = "pbMail";
                }
            }else{
                $userMail = $this->infoUser($id)['mail'];
            }
        }else{
            $userMail = $this->infoUser($id)['mail'];
        }
        // unique pseudo
        if(!empty($Post['newPseudo']) || $Post['newPseudo'] != ""){
            if($Post['newPseudo'] != $_SESSION['pseudo']){
                $newPseudo = $this->checkForDuplicate("users", htmlspecialchars($Post['newPseudo']));
                if($newPseudo == "nameOk"){
                    $userPseudo = htmlspecialchars($Post['newPseudo']);
                }else{
                    $userPseudo = $this->infoUser($id)['pseudo'];
                    $redirection .= "pbPseudo";
                }
            }else{
                $userPseudo = $_SESSION['pseudo'];
            }
        }else{
            $userPseudo = $this->infoUser($id)['pseudo'];
        }
        // Update the $_SESSION information with this update
        if($redirection == null || !str_contains($redirection != null, "pbPseudo")){
            $_SESSION['pseudo'] = $userPseudo;
        }
        if($redirection == null || !str_contains($redirection, "pbMail")){
            $_SESSION['mail'] = $userMail;
        }        
        $_SESSION['picture'] = $fileName;
        $_SESSION['mdp'] = $newMdp;
        // Update the DBB 
        $data = [
            ':id' => $id,
            ':picture' => $fileName,
            ':newPseudo' => $userPseudo,
            ':newMail' => $userMail,
            ':newUserPsw' => $newMdp
        ];
        $user->modifyUserAccountPost($data);
        if (!isset($redirection)){
            header('Location: indexAdmin.php?action=userAccount&status=success&from=modify');
        }elseif ($redirection == "pbMail"){
            header('Location: indexAdmin.php?action=userAccount&status=error&from=modifyMail');
        }elseif ($redirection == "pbPseudo"){
            header('Location: indexAdmin.php?action=userAccount&status=error&from=modifyPseudo');
        }elseif ($redirection == "pbMailpbPseudo"){
            header('Location: indexAdmin.php?action=userAccount&status=error&from=modifyMailPseudo');
        }
    }
}