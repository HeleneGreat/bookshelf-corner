<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class BookController extends Controller{

    function infoLivre($id){
        $new = new \Projet\Models\BookModel();
        $data = $new->singleBook($id);
        $datas = $data->fetch();
        return $datas;
    }

    function livresAll(){
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            if($_GET['from'] == "add"){
                $userMessage = new SubmitMessage ("success", "Le livre a bien été ajouté !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            elseif($_GET['from'] == "modify"){
                $userMessage = new SubmitMessage ("success", "Le livre a bien été modifié !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            elseif($_GET['from'] == "delete"){
                $userMessage = new SubmitMessage ("success", "Le livre a bien été supprimé !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            elseif($_GET['from'] == "duplicate"){
                $userMessage = new SubmitMessage ("error", "Ce livre existe déjà !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
        }
        return $this->validAccess("books-all", $datas);
    }

    function addLivre(){
        $new = new \Projet\Models\GenreModel();
        $data = $new->categoriesList();
        $datas = $data->fetchAll();
        return $this->validAccess("book-add", $datas);
    }

    function noCover(){
        // Default image if no book cover is submited
        return "no-cover.png";
    }

    function addLivrePost($Post, $Files){
        $new = new \Projet\Models\BookModel();
        $data = [
            ':newTitle' => htmlspecialchars( $Post['newTitle']),
            ':newAuthor' => htmlspecialchars($Post['newAuthor']),
            ':newYear_publication' => htmlspecialchars($Post['newYear_publication']),
            ':newGenre' => htmlspecialchars($Post['newGenre']),
            ':newEdition' => htmlspecialchars($Post['newEdition']),
            ':newLinkEdition' => htmlspecialchars($Post['newLinkEdition']),
            ':newLocation' => htmlspecialchars($Post['newLocation']),
            ':newCatchphrase' => htmlspecialchars($Post['newCatchphrase']),
            ':newContent' => htmlspecialchars($Post['newContent']),
            ':newNotation' => htmlspecialchars($Post['newNotation'])
        ];
        $new->addSingleBook($data);
        // Get book ID
        $book = new \Projet\Models\BookModel();
        $infoBook = $book->getId("books", "title", $data[':newTitle']);
        $idBook = $infoBook->fetch();
        $purpose = "book";
        $folder = "Books";
        if($Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $idBook['id']);
        } else{
            $fileName = $this->noCover();
        }
        $data = [
            ":id" => $idBook['id'],
            ":picture" => $fileName
        ];
        $this->updatePicture($data, 'books');
    }

    function viewLivre($id){
        $new = new \Projet\Models\BookModel();
        $data = $new->singleBook($id);
        $datas = $data->fetch();

        return $this->validAccess("book-view", $datas);
    }
  
    function modifyLivre($id){
        $newFirst = new \Projet\Models\BookModel();
        $dataFirst = $newFirst->singleBook($id);
        $datasFirst = $dataFirst->fetch();

        $newSecond = new \Projet\Models\GenreModel();
        $dataSecond = $newSecond->categoriesList();
        $datasSecond = $dataSecond->fetchAll();
        $datas = [
            "book" => $datasFirst,
            "genres" => $datasSecond
        ] ;
        return $this->validAccess("book-modify", $datas);
    }

    function modifyLivrePost($id, $Post, $Files){
        $new = new \Projet\Models\BookModel();
        $purpose = "book";
        $folder = "Books";
        if(!empty($Files) && $Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $id);
        } else{
            $fileName = $this->infoLivre($id)['picture'];
        }
         // unique book name
        if(!empty($Post['newTitle'])){
            if($Post['newTitle'] != ""){
                $newName = $this->checkForDuplicate("books", htmlspecialchars($Post['newTitle']));
                if($newName == "nameOk"){
                    $bookName = htmlspecialchars($Post['newTitle']);
                }
            }
        } else{
           $bookName = $this->infoLivre($id)['title'];
        }
        $data = [
            ':id' => $id,
            ':newTitle' => $bookName,
            ':newAuthor' => htmlspecialchars($Post['newAuthor']),
            ':newYear_publication' => htmlspecialchars($Post['newYear_publication']),
            ':newGenre' => htmlspecialchars($Post['newGenre']),
            ':newEdition' => htmlspecialchars($Post['newEdition']),
            ':newLinkEdition' => htmlspecialchars($Post['newLinkEdition']),
            ':newLocation' => htmlspecialchars($Post['newLocation']),
            ':newCatchphrase' => htmlspecialchars($Post['newCatchphrase']),
            ':newContent' => htmlspecialchars($Post['newContent']),
            ':picture' => $fileName,
            ':newNotation' => htmlspecialchars($Post['newNotation'])
        ];
        $datas = $new->modifySingleBook($data);
        header('Location: indexAdmin.php?action=livres&status=success&from=modify');
    }

    function deleteLivre($id){
        $new = new \Projet\Models\BookModel();
        $data = $new->deleteBook($id);
        $datas = $data->fetch();
        header('Location: indexAdmin.php?action=livres&status=success&from=delete');
    }
    
    /**************************/
    /********* SLIDER *********/
    /**************************/
    function livresSlider(){
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            $userMessage = new SubmitMessage ("success", "Le slider a été mis à jour !");
            $datas["feedback"] = $userMessage->formatedMessage();
        }
        return $this->validAccess("books-slider", $datas);
    }

    function sliderSelection($data){
        // First, all books in the DBB are set to slider = 0
        $allBooks = new \Projet\Models\BookModel();
        $sliderOff = $allBooks->sliderOff();
        // Second, the books selected in the slider form are set to 1
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->sliderOn($data);
        header('Location: indexAdmin.php?action=livres-slider&status=success');
    }
    
}