<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class GenreController extends Controller
{
    
    public function infoGenre($genreId)
    {
        $new = new \Projet\Models\GenreModel();
        $data = $new->infoGenre($genreId);
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
        $newGenre = [
            'genreId' => "0",
            'newGenre' => htmlspecialchars($Post['newType'])
        ];
        $genreName = $this->checkForDuplicate("genres", $newGenre);
        if($genreName == "nameOk"){
            $data = [':newType' => htmlspecialchars($Post['newType'])];
        }
        $new->genreAddPost($data);
        // Get genre ID
        $genre = new \Projet\Models\GenreModel();
        $infoGenre = $genre->getId("genres", "category", $data[':newType']);
        $genreId = $infoGenre->fetch();
        $purpose = "genre";
        $folder = "Books";
        $Files['picture']['name'] !== "" ? $fileName = $this->verifyFiles($purpose, $folder, $genreId['id']) : $fileName = $this->noIcon();
        $data = [
            ":id" => $genreId['id'],
            ":picture" => $fileName
        ];
        $this->updatePicture($data, 'genres');
    }

    public function genreModifyPost($genreId, $Post, $Files)
    {
        $new = new \Projet\Models\GenreModel(); 
        $purpose = "genre";
        $folder = "Books";
        if(!empty($Files) && $Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $genreId);
        } else{
            $fileName = $this->infoGenre($genreId)['picture'];
        }
        // unique genre name
        if(!empty($Post['newType'])){
            if($Post['newType'] != ""){
                $dataGenre = [
                    'genreId' => $genreId,
                    'newGenre' => htmlspecialchars($Post['newType'])
                ];
                $newName = $this->checkForDuplicate("genres", $dataGenre);
                if($newName == "nameOk"){
                    $genreName = htmlspecialchars($Post['newType']);
                }
            }
        } else{
            $genreName = $this->infoGenre($genreId)['category'];
        }
        $data = [
            ':id' => $genreId,
            ':newType' => $genreName,
            ':picture' => $fileName
        ];
        $new->genreModifyPost($data);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=modify');
    }

    public function deleteGenre($genreId)
    {
        $infoGenre = $this->infoGenre($genreId);
        if($infoGenre['picture'] != "no-icon.png"){
            unlink("./App/Public/Books/images/" . $infoGenre['picture']);
        }
        $replaceBooksGenre = new \Projet\Models\BookModel();
        $replaceBooksGenre->updateBookBeforeDeleteGenre($genreId);
        $deletedGenre = new \Projet\Models\GenreModel();
        $deletedGenre->deleteGenre($genreId);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=delete');
    }
}