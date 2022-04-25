<?php

namespace Projet\Controllers;

class Controller{

    function viewFront($viewName, $datas = null){
        $new = new \Projet\Models\BlogModel();
        $blogs = $new->blogInfo(1);
        $blog = $blogs->fetch();
        include('./App/Views/front/' . $viewName . '.php');
    }

    function viewAdmin($viewName, $datas = null){
        include('./App/Views/admin/' . $viewName . '.php');
    }

    protected function validAccess($path, $data = []){
        if (!empty($_SESSION)){
            if($_SESSION['mail'] != null){
                return $this->viewAdmin($path, $data);
            }else{
                header('Location: indexAdmin.php?action=error&status=error&from=no-access');
            }
        }else{ 
            header('Location: indexAdmin.php?action=error&status=error&from=no-access');
        }
    }

    function verifyFiles($purpose, $folder, $id){
        if(isset($_FILES['picture'])){
            $tmpName = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $size = $_FILES['picture']['size'];
            $error = $_FILES['picture']['error'];
        };
        // Get the file extension
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        // Extensions accepted
        $extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
        // Max size accepted in octet (2000000 octets = 2 Mo)
        $maxSize = 2000000;
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
            // Files are renamed like this example : "admin_22.png"
            $fileName = filter_var($purpose . "_" . $id . "." . $extension);
            // Files are saved in the App folders
            move_uploaded_file($tmpName, "./App/Public/$folder/images/" . $fileName);
            return $fileName;
        }
        else { echo "Une erreur est survenue. Vous devez ajouter une image de profil. La taille du fichier est limitée à 2 Mo. "; }
    }

    // After creation in BDD, update the BDD with the picture name
    function updatePicture($data, $table){
        if($table === 'administrators'){
            $new = new \Projet\Models\AdminModel();
            $datas = $new->updatePicture($data, $table); 
            header('Location: indexAdmin.php?action=connexionAdmin&status=success&from=create');
        }
        if($table === 'books'){
            $new = new \Projet\Models\BookModel(); 
            $datas = $new->updatePicture($data, $table); 
            header('Location: indexAdmin.php?action=livres&status=success&from=add');
        }
        if($table === 'genres'){
            $new = new \Projet\Models\BookModel(); 
            $datas = $new->updatePicture($data, $table);
            header('Location: indexAdmin.php?action=livres-genres&status=success&from=add');
        }       
    }

    function checkForDuplicate($table, $newName){
        if($table == "administrators"){
            $admin = new \Projet\Models\AdminModel();
            if(str_contains($newName, "@")){
                $admins = $admin->checkForDuplicate($table, "mail", $newName);
                $result = $admins->fetch();
                if(empty($result) || $result['id'] == $_SESSION['id']){
                    return "mailOk";
                }
            }
            if(!str_contains($newName, "@")){
                $admins = $admin->checkForDuplicate($table, "pseudo", $newName);
                $result = $admins->fetch();
                if(empty($result) || $result = false || $result['id'] == $_SESSION['id']){
                    return "pseudoOk";
                }
            }          
        }
        elseif($table == "books"){
            $book = new \Projet\Models\BookModel();
            $books = $book->checkForDuplicate($table, "title", $newName);
            $result = $books->fetch();
            if(empty($result)){
                return "nameOk";
            }else{
                header('Location: indexAdmin.php?action=livres&status=error&from=duplicate');
            }
        }
        elseif($table == "genres"){
            $new = new \Projet\Models\BookModel();
            $genre = $new->checkForDuplicate($table, "category", $newName);
            $result = $genre->fetch();
            if(empty($result)){
                return "nameOk";
            }else{
                header('Location: indexAdmin.php?action=livres-genres&status=error&from=duplicate');
            }
        }
        else{
            echo "Un des arguments a été mal enregistré";
        }
    }


    
}