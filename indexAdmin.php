<?php

use Projet\Controllers\AdminController;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

require_once('./App/class/UserMessage.php');

try{

    $adminController = new \Projet\Controllers\AdminController();
    
    $bookController = new \Projet\Controllers\BookController();

    $blogController = new \Projet\Controllers\BlogController();

    $messageController = new \Projet\Controllers\MsgController();



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

        /****************************/
        /******** TAB LIVRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres'){
            $bookController->livresAll();
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
                ':newTitle' => htmlspecialchars( $_POST['newTitle']),
                ':newAuthor' => htmlspecialchars($_POST['newAuthor']),
                ':newYear_publication' => htmlspecialchars($_POST['newYear_publication']),
                ':newGenre' => htmlspecialchars($_POST['newGenre']),
                ':newEdition' => htmlspecialchars($_POST['newEdition']),
                ':newLinkEdition' => htmlspecialchars($_POST['newLinkEdition']),
                ':newLocation' => htmlspecialchars($_POST['newLocation']),
                ':newCatchphrase' => htmlspecialchars($_POST['newCatchphrase']),
                ':newContent' => htmlspecialchars($_POST['newContent']),
                ':picture' => $fileName,
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
                ':picture' => $fileName,
                ':newNotation' => htmlspecialchars($_POST['newNotation'])
            ];
            $bookController->modifyLivrePost($data);
        }  
        
        elseif ($_GET['action'] == "livresdelete"){
            $id = $_GET['id'];
            $bookController->deleteLivre($id);
        }

        /****************************/
        /******** TAB GENRES ********/
        /****************************/
        elseif($_GET['action'] == 'livres-genres'){
            $bookController->livresGenres();
        }

        elseif ($_GET['action'] == "genreAddPost"){
            $purpose = "genre";
            $folder = "Books";
            if($_FILES['picture']['name'] !== ""){
                $fileName = $bookController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $bookController->noIcon();
            }
            $data = [
                ':newType' => htmlspecialchars( $_POST['newType']),
                ':newIcon' => $fileName
            ];
            $bookController->genreAddPost($data);
        }

        elseif ($_GET['action'] == "genreModifyPost"){
            $purpose = "genre";
            $folder = "Books";
            $id = $_GET['id'];
            // input file
            if(!empty($_FILES) && $_FILES['picture']['name'] !== ""){
                $fileName = $bookController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $bookController->infoGenre($id)['icon'];
            }
            // unique name
            // if(!empty($_POST['newType'])){
            //     $newName = $bookController->checkForDuplicate("genres", htmlspecialchars( $_POST['newType']));
            //     if($newName == false){
            //         $genreName = htmlspecialchars( $_POST['newType']);
            //     }
            //     else{ 
            //         $bookController->livresGenres();
            //        }
            // } else{
            //     $genreName = $bookController->infoGenre($id)['category'];
            // }
            // Données issues du formulaire
            $data = [
                ':id' => $id,
                ':newType' => htmlspecialchars($_POST['newType']),
                ':newIcon' => $fileName
            ];
            $bookController->genreModifyPost($data);
        }  

        elseif ($_GET['action'] == "genreDelete"){
            $id = $_GET['id'];
            $bookController->deleteGenre($id);
        }

        /****************************/
        /******** TAB SLIDER ********/
        /****************************/
        elseif($_GET['action'] == 'livres-slider'){
            $bookController->livresSlider();
        }

        elseif($_GET['action'] == "sliderModifyPost"){
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
            // Check if there is a new picture uploaded
            if($_FILES['picture']['name'] !== ""){
                $fileName = $adminController->verifyFiles($purpose, $folder);
            } else{
                $fileName = $_SESSION['picture'] ;
            }
            // Psw update
            if(!empty($_POST['newAdminPsw'])){
                // Check if actual psw is correct
                $actualAdminPsw = htmlspecialchars($_POST['actualAdminPsw']);
                $getInfo = $adminController->infoAdmin();    
                $isPasswordCorrect = password_verify($actualAdminPsw, $getInfo['mdp']);
                if ($isPasswordCorrect){
                    $newPsw = $_POST['newAdminPsw'];
                    $newMdp = password_hash($newPsw, PASSWORD_DEFAULT);                    
                }
                else{
                    echo "Mot de passe incorrect";
                    $adminController->accountModify(); 
                }
            }
            // Update the $_SESSION information with this update
            $_SESSION['pseudo'] = $_POST['newPseudo'];
            $_SESSION['mail'] = $_POST['newMail'];
            $_SESSION['picture'] = $fileName;
            // Update the DBB 
            $data = [
                ':id' => $_GET['id'],
                ':picture' => $fileName,
                ':newPseudo' => htmlspecialchars($_POST['newPseudo']),
                ':newMail' => htmlspecialchars($_POST['newMail']),
                ':newAdminPsw' => $newMdp
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
   

        /********************************************************/
        /*********************** COMMENTS ***********************/
        /********************************************************/
        elseif($_GET['action'] == "comments"){
            $adminController->comments();
        }   


        /********************************************************/
        /*********************** MESSAGES ***********************/
        /********************************************************/

        elseif($_GET['action'] == "messages"){
            $messageController->allMessages();
        }

        elseif($_GET['action'] == "messageview"){
            $id = $_GET['id'];
            $messageController->viewMessage($id);
        }   

        elseif ($_GET['action'] == "messageDelete"){
            $id = $_GET['id'];
            $messageController->deleteMessage($id);
        }






        elseif($_GET['action'] == "error"){
            $adminController->error();
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

catch (Error $e){
    return $this->validAccess('error');
}