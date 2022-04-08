<?php

namespace Projet\Controllers;

class Controller{

    function viewFront($viewName, $datas = null){
        include('./App/Views/front/' . $viewName . '.php');
    }

    function viewAdmin($viewName, $datas = null){
        include('./App/Views/admin/' . $viewName . '.php');
    }

    function verifyFiles($purpose, $folder){
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

        // Max size accepted in octet (8000000 octets = 8 Mo)
        $maxSize = 8000000;

        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
            date_default_timezone_set("Europe/Paris");
            // Files are renamed like this example : "logo_2022-03-29_16-25-36.png"
            $fileName = $purpose . "_" . date("Y-m-d_H-i-s") . "." . $extension;
            // Files are saved in the App
            move_uploaded_file($tmpName, "./App/Public/$folder/images/" . $fileName);
            return $fileName;
        }

        else if($error == 1) { 
            echo "La taille du fichier est trop grande"; }
        else if($error == 2) { 
            echo "La taille du fichier est trop grande"; }
        else if($error == 3) { 
            echo "Téléchargement du fichier incomplet"; }
        else if($error == 4) { 
            echo "Aucun fichier téléchargé"; }
        else if($error == 6) { 
            echo "Il manque un fichier temporaire"; }
        else if($error == 7) { 
            echo "Impossible d'enregistrer le fichier"; }
        else if($error == 8) { 
            echo "Une extension PHP a empêché le téléchargement du fichier"; }
    }

    function checkForDuplicate($table, $newName){
        if($table == "admins"){
            $admin = new \Projet\Models\AdminModel();
            $admins = $admin->allAdmins();
            $check = $admins->fetchAll();
            if (in_array($newName, $check)){
                return false;
            } else{
                return true;
            } 
        }
        elseif($table == "books"){
            $book = new \Projet\Models\BookModel();
            $books = $book->allBooks();
            $check = $books->fetchAll();
            if (in_array($newName, $check)){
                return false;
            } else{
                return true;
            }
        }
        elseif($table == "genres"){
            $genre = new \Projet\Models\BookModel();
            $genres = $genre->allGenres();
            $check = $genres->fetchAll();
            if (in_array($newName, $check)){
                return false;
            } else{
                return true;
            }
        }
        else{
            echo "Un des arguments a été mal enregistré";
        }
    }

}