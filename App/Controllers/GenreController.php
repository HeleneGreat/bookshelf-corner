<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class GenreController extends Controller
{
    
    // Get genre information
    public function infoGenre($genreId)
    {
        $new = new \Projet\Models\GenreModel();
        $data = $new->infoGenre($genreId);
        $datas = $data->fetch();
        return $datas;
    }

    // Genre page in admin
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

    // Default image if no genre picture is submited
    public function noIcon()
    {
        return "no-icon.png";
    }

    // Add this new genre
    public function genreAddPost($Post, $Files)
    {
        $new = new \Projet\Models\GenreModel();
        $newGenre = [
            'genreId' => "0",
            'newGenre' => htmlspecialchars($Post['newType'])
        ];
        // Verify genre name is unique
        $genreName = $this->checkForDuplicate("genres", $newGenre);
        if($genreName == "nameOk"){
            $data = [':newType' => htmlspecialchars($Post['newType'])];
        }
        // Save in DB
        $new->genreAddPost($data);
        // Get genre ID
        $genre = new \Projet\Models\GenreModel();
        $infoGenre = $genre->getId("genres", "category", $data[':newType']);
        $genreId = $infoGenre->fetch();
        // Add genre picture
        $purpose = "genre";
        $folder = "Books";
        $Files['picture']['name'] !== "" ? $fileName = $this->verifyFiles($purpose, $folder, $genreId['id']) : $fileName = $this->noIcon();
        $data = [
            ":id" => $genreId['id'],
            ":picture" => $fileName
        ];
        $this->updatePicture($data, 'genres');
    }

    // Update this genre
    public function genreModifyPost($genreId, $Post, $Files)
    {
        $new = new \Projet\Models\GenreModel();
        // Genre picture
        $purpose = "genre";
        $folder = "Books";
        if(!empty($Files) && $Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $genreId);
        } else{
            $fileName = $this->infoGenre($genreId)['picture'];
        }
        // Verify genre name is unique
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
        // Update this genre
        $data = [
            ':id' => $genreId,
            ':newType' => $genreName,
            ':picture' => $fileName
        ];
        $new->genreModifyPost($data);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=modify');
    }

    // Delete this genre
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