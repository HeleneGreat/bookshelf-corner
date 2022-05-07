<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class GenreController extends Controller{
    
    function infoGenre($id){
        $new = new \Projet\Models\GenreModel();
        $data = $new->infoGenre($id);
        $datas = $data->fetch();
        return $datas;
    }

    function livresGenres(){
        $new = new \Projet\Models\GenreModel();
        $data = $new->allGenres();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            if($_GET['from'] == "add"){
                $userMessage = new SubmitMessage ("success", "La catégorie a bien été ajoutée !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            elseif($_GET['from'] == "modify"){
                $userMessage = new SubmitMessage ("success", "La catégorie a bien été modifiée !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            elseif($_GET['from'] == "delete"){
                $userMessage = new SubmitMessage ("success", "La catégorie a bien été supprimée !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            elseif($_GET['from'] == "duplicate"){
                $userMessage = new SubmitMessage ("error", "Cette catégorie existe déjà !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
        }
        return $this->validAccess("books-genres", $datas);
    }

    function noIcon(){
        return "no-icon.png";
    }

    function allGenre(){
        $new = new \Projet\Models\GenreModel();
        $data = $new->allGenres();
        $datas = $data->fetchAll();
        return $this->validAccess("books-genres", $datas);
    }

    function genreAddPost($Post, $Files){
        $new = new \Projet\Models\GenreModel();
        $data = [':newType' => htmlspecialchars($Post['newType'])];
        $new->genreAddPost($data);
        // Get book ID
        $genre = new \Projet\Models\GenreModel();
        $infoGenre = $genre->getId("genres", "category", $data[':newType']);
        $idGenre = $infoGenre->fetch();
        $purpose = "genre";
        $folder = "Books";
        if($Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $idGenre['id']);
        } else{
            $fileName = $this->noIcon();
        }
        $data = [
            ":id" => $idGenre['id'],
            ":picture" => $fileName
        ];
        $this->updatePicture($data, 'genres');
    }

    function genreModifyPost($id, $Post, $Files){
        $new = new \Projet\Models\GenreModel(); 
        $purpose = "genre";
        $folder = "Books";
        if(!empty($Files) && $Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $id);
        } else{
            $fileName = $this->infoGenre($id)['picture'];
        }
        // unique genre name
        if(!empty($Post['newType'])){
             if($Post['newType'] != ""){
                $newName = $this->checkForDuplicate("genres", htmlspecialchars($Post['newType']));
                if($newName == "nameOk"){
                    $genreName = htmlspecialchars($Post['newType']);
                }
            }
        } else{
            $genreName = $this->infoGenre($id)['category'];
        }
        $data = [
            ':id' => $id,
            ':newType' => $genreName,
            ':picture' => $fileName
        ];
        $datas = $new->genreModifyPost($data);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=modify');
    }

    function deleteGenre($id){
        $new = new \Projet\Models\GenreModel();
        $data = $new->deleteGenre($id);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=delete');
    }

}