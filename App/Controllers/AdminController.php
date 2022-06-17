<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class AdminController extends Controller
{

    /********************************************************/
    /******************* CONNECTION ADMIN *******************/
    /********************************************************/
    // Add an admin account page
    public function addAdmin()
    {
        if($_SESSION['role'] == 2){
            if(isset($_GET['status'])){
                $statusMessage = new SubmitMessage("","");
                $datas['feedback'] = $statusMessage->accountMessage();
                return $this->viewAdmin("connexion/createAdmin", $datas);
            }else{
            return $this->viewAdmin("connexion/createAdmin");
            } 
        } else{
            header('Location: indexAdmin.php?action=error&status=error&from=no-access'); 
        }
    }

    // Add an admin account form
    public function createAdminPost ($Post, $Files){
        $redirection = "";
        // Verify picture size is < 1 Mo
        if(isset($Files['picture']['size']) && $Files['picture']['size'] > 1000000){
            header('Location: indexAdmin.php?action=createAccount&status=error&&from=img');
            return;
        }
        // Verify if pseudo is unique
        $createAdmin = new \Projet\Models\AdminModel;
        $pseudo = $this->checkForDuplicate("administrators", htmlspecialchars($Post['adminPseudo']));
        if($pseudo == "nameOk"){
            $data[':pseudo'] = htmlspecialchars($Post['adminPseudo']);
        }else{
            $redirection .= "pbPseudo";
        }
        // Verify if mail is unique
        $mail = $this->checkForDuplicate("administrators", htmlspecialchars($Post['adminMail']));
        if($mail == "nameOk"){
            $data[':mail'] = htmlspecialchars($Post['adminMail']);
        }else{
            $redirection .= "pbMail";
        }
        // Redirection if the pseudo or mail are already taken
        if($redirection == "pbMail"){
            header('Location: indexAdmin.php?action=createAccount&status=error&from=createAccountMail');
        }elseif ($redirection == "pbPseudo"){
            header('Location: indexAdmin.php?action=createAccount&status=error&from=createAccountPseudo');
        }elseif ($redirection == "pbPseudopbMail"){
            header('Location: indexAdmin.php?action=createAccount&status=error&from=createAccountMailPseudo');
        }
        // Password hash
        $pass = htmlspecialchars($Post['adminMdp']);
        $mdp = password_hash($pass, PASSWORD_DEFAULT);
        $picture = $Files['picture']['name'];
        $data[':mdp'] = $mdp;
        if(!empty($pseudo) && (!empty($data[':mail']) && (!empty($mdp) && (!empty($picture))))){
            if(filter_var($data[':mail'], FILTER_VALIDATE_EMAIL)){
                // create admin in DB
                $createAdmin->createAdmin($data);
                // Get his ID
                $user = new \Projet\Models\AdminModel;
                $admin = $user->getId("administrators", "mail", $data[':mail']);
                $adminId = $admin->fetch();
                // Second: save his picture
                $purpose = "admin";
                $folder = "Admin";
                $fileName = $this->verifyFiles($purpose, $folder, $adminId['id']);
                // Third: update DB with new picture name
                $data = [
                    "id" => $adminId['id'],
                    "picture" => $fileName
                ];
                $this->updatePicture($data, 'administrators');
            }
        } else {
            $userMessage = new SubmitMessage("error", "Tous les champs doivent être remplis !");
            $data["feedback"] = $userMessage->formatedMessage();
            return $this->validAccess("error", $data);
        }
    }

    // Connexion to admin account page
    public function connexionAdmin()
    {
        $datas=[];
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->accountMessage();
        }
        return $this->viewAdmin("connexion/connexionAdmin", $datas);
    }

    // Connexion to admin account form
    public function connexionAdminPost($mail, $mdp)
    {
        // get password
        $user = new \Projet\Models\AdminModel();
        $connexAdmin = $user->infoConnexion($mail);
        $result = $connexAdmin->fetch();
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
    // Admin dashboard stats page
    public function dashboard() {
        // Books stats
        $countBooks = new \Projet\Models\BookModel();
        $nbBooks = $countBooks->countBooks();
        $lastBooks = $countBooks->allBooks();
        $lastBook = $lastBooks->fetch();
        // Messages stats
        $countMails = new \Projet\Models\MsgModel();
        $nbMails = $countMails->countMessages();
        $lastMails = $countMails->allMessages();
        $lastMail = $lastMails->fetch();
        // Comments stats
        $countComments = new \Projet\Models\CommentModel();
        $nbComments = $countComments->countComments();
        $lastComments = $countComments->allComments();
        $lastComment = $lastComments->fetch();
        // Users stats
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
    // Information about this admin
    public function infoAdmin($adminId)
    {
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($adminId);
        $infoAdmin = $admin->fetch();
        return $infoAdmin;
    }

    // Admin account page
    public function account()
    {
        $adminId = $_SESSION['id'];
        $user = new \Projet\Models\AdminModel();
        $admin = $user->infoAdmin($adminId);
        $datas = $admin->fetch();
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->modifyAccountMessage();
        }
        return $this->validAccess("account", $datas);
    }

    // Modify account page
    public function accountModify()
    {
        $adminId = $_SESSION['id'];
        // Admin
        if($_SESSION['role'] > 0){
            $new = new \Projet\Models\AdminModel();
            $admin = $new->infoAdmin($adminId);
            $infoAdmin = $admin->fetch();
            $this->validAccess("account-modify", $infoAdmin);
        // User
        }else{
            $new = new \Projet\Models\UserModel();
            $user = $new->infoUser($adminId);
            $infoUser = $user->fetch();
            $this->viewUser("account-modify", $infoUser);
        }
    }

    // Modify admin account form
    public function accountModifyPost($adminId, $Post, $Files)
    {
        $admin = new \Projet\Models\AdminModel();
        $purpose = "admin";
        $folder = "Admin";
        $redirection = null;
        // Verify picture size is < 1 Mo
        if(isset($Files['picture']['size']) && $Files['picture']['size'] > 1000000){
            header('Location: indexAdmin.php?action=account&status=error&&from=img');
            return;
        }
        // Picture update
        ($Files['picture']['name'] !== "") ? $fileName = $this->verifyFiles($purpose, $folder, $adminId) : $fileName = $this->infoAdmin($adminId)['picture'] ;
        // Psw update
        if(!empty($Post['newPsw']) || $Post['newPsw'] != ""){
            // Check if actual psw is correct
            $actualAdminPsw = htmlspecialchars($Post['actualPsw']);
            $getInfo = $this->infoAdmin($adminId);    
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
            $newMdp = $this->infoAdmin($adminId)['mdp'];
        }
        // Update email if unique
        if(!empty($Post['newMail']) || $Post['newMail'] != ""){
            if($Post['newMail'] != $_SESSION['mail']){
                $newMail = $this->checkForDuplicate("administrators", htmlspecialchars($Post['newMail']), "accountUpdate");
                if($newMail == "nameOk"){
                    $adminMail = htmlspecialchars($Post['newMail']);
                }else{
                    $adminMail = $this->infoAdmin($adminId)['mail'];
                    $redirection = "pbMail";
                }
            }else{
                $adminMail = $this->infoAdmin($adminId)['mail'];
            }
        }else{
            $adminMail = $this->infoAdmin($adminId)['mail'];
        }
        // Update pseudo if unique
        if(!empty($Post['newPseudo']) || $Post['newPseudo'] != ""){
            if($Post['newPseudo'] != $_SESSION['pseudo']){
                $newPseudo = $this->checkForDuplicate("administrators", htmlspecialchars($Post['newPseudo']), "accountUpdate");
                if($newPseudo == "nameOk"){
                    $adminPseudo = htmlspecialchars($Post['newPseudo']);
                }else{
                    $adminPseudo = $this->infoAdmin($adminId)['pseudo'];
                    $redirection .= "pbPseudo";
                }
            }else{
                $adminPseudo = $_SESSION['pseudo'];
            }
        }else{
            $adminPseudo = $this->infoAdmin($adminId)['pseudo'];
        }
        // Update the $_SESSION information with this update
        if($redirection == null || !strpos($redirection != null, "pbPseudo")){
            $_SESSION['pseudo'] = $adminPseudo;
        }
        if($redirection == null || !strpos($redirection, "pbMail")){
            $_SESSION['mail'] = $adminMail;
        }        
        $_SESSION['picture'] = $fileName;
        $_SESSION['mdp'] = $newMdp;
        // Update the DB 
        $data = [
            ':id' => $adminId,
            ':picture' => $fileName,
            ':newPseudo' => $adminPseudo,
            ':newMail' => $adminMail,
            ':newAdminPsw' => $newMdp
        ];
        $admin->modifyAccountPost($data);
        // Redirections
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
    // Error page if trying to access admin page while not connected
    public function error()
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