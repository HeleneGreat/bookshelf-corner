<?php

use Projet\Controllers\AdminController;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

try{

    $adminController = new \Projet\Controllers\AdminController();
    
    $bookController = new \Projet\Controllers\BookController();

    $blogController = new \Projet\Controllers\BlogController();



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

            $picture = $_FILES['picture'];
            $purpose = "admin";
            $folder = "Admin";
            $fileName = $adminController->verifyFiles($purpose, $folder);

            if(!empty($pseudo) && (!empty($mail) && (!empty($mdp) && (!empty($fileName))))){
                // echo "les champs sont bien remplis";
                $adminController->createAdminPost($pseudo, $mail, $mdp, $fileName);
            }
            else{
                echo "il manque des champs";
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
            $bookController->livres();
        }

        elseif ($_GET['action'] == "livresview"){
            $id = $_GET['id'];
            $bookController->viewLivre($id);
        }
        
        elseif ($_GET['action'] == "livresadd"){
            $bookController->addLivre();
        }

        elseif ($_GET['action'] == "livresaddPost"){
            $purpose = "book";
            $folder = "Books";
            if($_FILES['picture']['name'] !== ""){
                $fileName = $bookController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $bookController->noCover();
            }
            $data = [
                'newTitle' => htmlspecialchars( $_POST['newTitle']),
                ':newAuthor' => htmlspecialchars($_POST['newAuthor']),
                ':newYear_publication' => htmlspecialchars($_POST['newYear_publication']),
                ':newGenre' => htmlspecialchars($_POST['newGenre']),
                ':newEdition' => htmlspecialchars($_POST['newEdition']),
                ':newLinkEdition' => htmlspecialchars($_POST['newLinkEdition']),
                ':newLocation' => htmlspecialchars($_POST['newLocation']),
                ':newCatchphrase' => htmlspecialchars($_POST['newCatchphrase']),
                ':newContent' => htmlspecialchars($_POST['newContent']),
                ':newPicture' => $fileName,
                ':newNotation' => htmlspecialchars($_POST['newNotation'])
            ];
            $bookController->addLivrePost($data);
        }

        elseif ($_GET['action'] == "livresmodify"){
            $id = $_GET['id'];
            $bookController->modifyLivre($id);
        }

        elseif ($_GET['action'] == "livresmodifyPost"){
            $purpose = "book";
            $folder = "Books";
            $id = $_GET['id'];
            if(!empty($_FILES) && $_FILES['picture']['name'] !== ""){
                $fileName = $bookController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $bookController->infoLivre($id)['picture'];
            }
            $data = [
                ':id' => $_GET['id'],
                ':newTitle' => htmlspecialchars($_POST['newTitle']),
                ':newAuthor' => htmlspecialchars($_POST['newAuthor']),
                ':newYear_publication' => htmlspecialchars($_POST['newYear_publication']),
                ':newGenre' => htmlspecialchars($_POST['newGenre']),
                ':newEdition' => htmlspecialchars($_POST['newEdition']),
                ':newLinkEdition' => htmlspecialchars($_POST['newLinkEdition']),
                ':newLocation' => htmlspecialchars($_POST['newLocation']),
                ':newCatchphrase' => htmlspecialchars($_POST['newCatchphrase']),
                ':newContent' => htmlspecialchars($_POST['newContent']),
                ':newPicture' => $fileName,
                ':newNotation' => htmlspecialchars($_POST['newNotation'])
            ];
            $bookController->modifyLivrePost($data);
        }  

        elseif ($_GET['action'] == "livresdelete"){
            $id = $_GET['id'];
            $bookController->deleteLivre($id);
        }


    /*********************************************************/
    /********************* LIVRES SLIDER *********************/
    /*********************************************************/
        elseif($_GET['action'] == "book-slider"){
            $bookController->sliderSelection($_POST);
        }


        
    /*********************************************************/
    /********************* ADMIN ACCOUNT *********************/
    /*********************************************************/
        elseif($_GET['action'] == "account"){
            $adminController->account();
        }

        elseif($_GET['action'] == "accountModify"){
            $adminController->accountModify();
        }

        elseif($_GET['action'] == "accountModifyPost"){
            $purpose = "admin";
            $folder = "Admin";
            // check if there is a new picture uploaded
            if($_FILES['picture']['name'] !== ""){
                $fileName = $adminController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $_SESSION['picture'] ;
            }

            $pass = htmlspecialchars($_POST['adminMdp']);
            $mdp = password_hash($pass, PASSWORD_DEFAULT);


            if(!empty($pseudo) && (!empty($mail) && (!empty($mdp) && (!empty($fileName))))){
                // echo "les champs sont bien remplis";
                $adminController->createAdminPost($pseudo, $mail, $mdp, $fileName);
            }





            // update the $_SESSION information with this update
            $_SESSION['pseudo'] = $_POST['newPseudo'];
            $_SESSION['mail'] = $_POST['newMail'];
            $_SESSION['picture'] = $fileName;
            $data = [
                ':id' => $_GET['id'],
                ':picture' => $fileName,
                ':newPseudo' => htmlspecialchars($_POST['newPseudo']),
                ':newMail' => htmlspecialchars($_POST['newMail'])
            ];
            $adminController->accountModifyPost($data);
        }
        
        /*********************************************************/
        /******************** BLOG PARAMETERS ********************/
        /*********************************************************/
        elseif($_GET['action'] == "blogParameters"){
            $id = "1";
            $blogController->blogParameters($id);
        }

        elseif($_GET['action'] == "blogModify"){
            $id = "1";
            $blogController->blogModify($id);
        }

        elseif($_GET['action'] == "blogModifyPost"){
            $purpose = "logo";
            $folder = "Admin";
            $id = "1";
            // check if there is a picture uploaded
            if($_FILES['picture']['name'] !== ""){
                $fileName = $adminController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $blogController->blogInfo($id)['logo'];
            }
            // check is there is a new blog name
            if($_POST['newBlog'] !== ""){
                $blogName = htmlspecialchars($_POST['newBlog']);
            }
            else{
                $blogName = $blogController->blogInfo($id)['name'];
            }
            $data = [
                ':picture' => $fileName,
                ':newBlog' => $blogName
            ];
            $adminController->blogModifyPost($data);
        }

        elseif($_GET['action'] == "comments"){
            $adminController->comments();
        }

        elseif($_GET['action'] == "messages"){
            $adminController->messages();
        }


    }
    else{
        $adminController->connexionAdmin();
    }
}

catch (Exception $e){
    
    // return $this->viewAdmin("error");
    echo $e->getMessage();
}