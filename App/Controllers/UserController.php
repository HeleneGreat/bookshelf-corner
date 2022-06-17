<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class UserController extends Controller
{
    /********************************************************/
    /************** CREATION / CONNECTION USER **************/
    /********************************************************/
    // Create a user account page
    public function createUser()
    {
        $datas=[];
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->accountMessage();
        }
        return $this->viewFront("user-create", $datas);
    }

    // Create a user account form
    public function createUserPost ($Post, $Files)
    {
        $redirection = "";
        // Verify picture size is < 1 Mo
        if(isset($Files['picture']['size']) && $Files['picture']['size'] > 1000000){
            header('Location: index.php?action=createUser&status=error&&from=img');
            return;
        }
        // Verify if pseudo is unique
        $createUser = new \Projet\Models\UserModel;
        $pseudo = $this->checkForDuplicate("users", htmlspecialchars($Post['userPseudo']));
        if($pseudo == "nameOk"){
            $data[':pseudo'] = htmlspecialchars($Post['userPseudo']);
        }else{
            $redirection .= "pbPseudo";
        }
        // Verify if mail is unique
        $mail = $this->checkForDuplicate("users",htmlspecialchars($Post['userMail']));
        if($mail == "nameOk"){
            $data[':mail'] = htmlspecialchars($Post['userMail']);
        }else{
            $redirection .= "pbMail";
        }
        // Redirection if the pseudo or mail are already taken
        if($redirection == "pbMail"){
            header('Location: index.php?action=createUser&status=error&from=createAccountMail');
        }elseif ($redirection == "pbPseudo"){
            header('Location: index.php?action=createUser&status=error&from=createAccountPseudo');
        }elseif ($redirection == "pbPseudopbMail"){
            header('Location: index.php?action=createUser&status=error&from=createAccountMailPseudo');
        }
        // Password hash
        $pass = htmlspecialchars($Post['userMdp']);
        $mdp = password_hash($pass, PASSWORD_DEFAULT);
        $data[':mdp'] = $mdp;
        if(!empty($pseudo) && (!empty($mail) && (!empty($mdp))))
        {
            if(filter_var($data[':mail'], FILTER_VALIDATE_EMAIL)){
                // create user in DB
                $createUser->createUser($data);
                if($Files['picture']['name'] != ""){
                    // Get his ID
                    $new = new \Projet\Models\UserModel;
                    $user= $new->getId("users", "mail", $data[':mail']);                
                    $userId = $user->fetch();
                    // Second: save his picture if there is one
                    $purpose = "user";
                    $folder = "Users";
                    $fileName = $this->verifyFiles($purpose, $folder, $userId['id']);
                    // Third: update DB with new picture name
                    $data = [
                        "id" => $userId['id'],
                        "picture" => $fileName
                    ];
                    $this->updatePicture($data, 'users');
                }else{
                    header('Location: index.php?action=connexionUser&status=success&from=createUser');
                }
            }
        }
        else{
            $userMessage = new SubmitMessage("error", "Les champs suivis d'une astérisque sont obligatoires ! !");
            $data["feedback"] = $userMessage->formatedMessage();
            return $this->viewFront("user-create", $data);
        }
    }

    // Connexion to user account page
    public function connexionUser()
    {
        $datas=[];
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->accountMessage();
        }
        return $this->viewFront("user-connexion", $datas);
    }

    // Connexion to user account form
    public function connexionUserPost($mail, $mdp)
    {
        // get password
        $user = new \Projet\Models\UserModel();
        $connexUser = $user->infoConnexion($mail);
        $result = $connexUser->fetch();
        if(!empty($result)){
            // If password is correct => create a session
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
                header('Location: index.php?action=connexionUser&status=error&from=connexionPsw');
            }
        }else{
            header('Location: index.php?action=connexionUser&status=error&from=connexionMail');
        }
    }

    /****************************************************/
    /******************* USER ACCOUNT *******************/
    /****************************************************/
    // User dashboard stats page
    public function userDashboard()
    {
        // Comments stats
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

    // Information about this user
    public function infoUser($userId)
    {
        $new = new \Projet\Models\UserModel();
        $user = $new->infoUser($userId);
        $infoUser = $user->fetch();
        return $infoUser;
    }

    // User account page
    public function userAccount()
    {
        $userId = $_SESSION['id'];
        $user = new \Projet\Models\UserModel();
        $users = $user->infoUser($userId);
        $datas = $users->fetch();
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->modifyAccountMessage();
        }
        return $this->viewUser("account", $datas);
    }

    // Modify user account form
    public function userAccountModifyPost($userId, $Post, $Files)
    {
        $user = new \Projet\Models\UserModel();
        $purpose = "user";
        $folder = "Users";
        $redirection = null;
        // Verify picture size is < 1 Mo
        if(isset($Files['picture']['size']) && $Files['picture']['size'] > 1000000){
            header('Location: indexAdmin.php?action=userAccount&status=error&&from=img');
            return;
        }
        // Picture update
        ($Files['picture']['name'] !== "") ? $fileName = $this->verifyFiles($purpose, $folder, $userId) : $fileName = $this->infoUser($userId)['picture'] ;
        // Psw update
        if(!empty($Post['newPsw']) || $Post['newPsw'] != ""){
            // Check if actual psw is correct
            $actualUserPsw = htmlspecialchars($Post['actualPsw']);
            $getInfo = $this->infoUser($userId);    
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
            $newMdp = $this->infoUser($userId)['mdp'];
        }
        // Update email if unique
        if(!empty($Post['newMail']) || $Post['newMail'] != ""){
            if($Post['newMail'] != $_SESSION['mail']){
                $newMail = $this->checkForDuplicate("users", htmlspecialchars($Post['newMail']));
                if($newMail == "nameOk"){
                    $userMail = htmlspecialchars($Post['newMail']);
                }else{
                    $userMail = $this->infoUser($userId)['mail'];
                    $redirection = "pbMail";
                }
            }else{
                $userMail = $this->infoUser($userId)['mail'];
            }
        }else{
            $userMail = $this->infoUser($userId)['mail'];
        }
        // Update pseudo if unique
        if(!empty($Post['newPseudo']) || $Post['newPseudo'] != ""){
            if($Post['newPseudo'] != $_SESSION['pseudo']){
                $newPseudo = $this->checkForDuplicate("users", htmlspecialchars($Post['newPseudo']));
                if($newPseudo == "nameOk"){
                    $userPseudo = htmlspecialchars($Post['newPseudo']);
                }else{
                    $userPseudo = $this->infoUser($userId)['pseudo'];
                    $redirection .= "pbPseudo";
                }
            }else{
                $userPseudo = $_SESSION['pseudo'];
            }
        }else{
            $userPseudo = $this->infoUser($userId)['pseudo'];
        }
        // Update the $_SESSION information with this update
        if($redirection == null || !strpos($redirection != null, "pbPseudo")){
            $_SESSION['pseudo'] = $userPseudo;
        }
        if($redirection == null || !strpos($redirection, "pbMail")){
            $_SESSION['mail'] = $userMail;
        }        
        $_SESSION['picture'] = $fileName;
        $_SESSION['mdp'] = $newMdp;
        // Update the DB 
        $data = [
            ':id' => $userId,
            ':picture' => $fileName,
            ':newPseudo' => $userPseudo,
            ':newMail' => $userMail,
            ':newUserPsw' => $newMdp
        ];
        $user->modifyUserAccountPost($data);
        // Redirections
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