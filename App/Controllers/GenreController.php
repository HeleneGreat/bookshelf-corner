<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class GenreController extends Controller
{
    
    public function infoGenre($id)
    {
        $new = new \Projet\Models\GenreModel();
        $data = $new->infoGenre($id);
        $datas = $data->fetch();
        return $datas;
    }

    public function livresGenres()
    {
        $new = new \Projet\Models\GenreModel();
        $data = $new->allGenres();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->genresMessage();
        }
        return $this->validAccess("books-genres", $datas);
    }

    public function noIcon()
    {
        return "no-icon.png";
    }

    public function allGenre()
    {
        $new = new \Projet\Models\GenreModel();
        $data = $new->allGenres();
        $datas = $data->fetchAll();
        return $this->validAccess("books-genres", $datas);
    }

    public function genreAddPost($Post, $Files)
    {
        $new = new \Projet\Models\GenreModel();
        $genreName = $this->checkForDuplicate("genres", htmlspecialchars($Post['newType']));
        if($genreName == "nameOk"){
            $data = [':newType' => htmlspecialchars($Post['newType'])];
        }
        $new->genreAddPost($data);
        // Get genre ID
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

    public function genreModifyPost($id, $Post, $Files)
    {
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

    public function deleteGenre($idGenre)
    {
        $infoGenre = $this->infoGenre($idGenre);
        if($infoGenre['picture'] != "no-icon.png"){
            unlink("./App/Public/Books/images/" . $infoGenre['picture']);
        }
        $deletedGenre = new \Projet\Models\GenreModel();
        $deletedGenre->deleteGenre($idGenre);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=delete');
    }

}