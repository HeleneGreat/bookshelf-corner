<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class BookController extends Controller{

    // First admin methods, then front

    function infoLivre($id){
        $new = new \Projet\Models\BookModel();
        $data = $new->singleBook($id);
        $datas = $data->fetch();
        return $datas;
    }

    function infoGenre($id){
        $new = new \Projet\Models\BookModel();
        $data = $new->infoGenre($id);
        $datas = $data->fetch();
        return $datas;
    }


    /*=======================================================*/
    /*=======================================================*/
    /*======================== ADMIN ========================*/
    /*=======================================================*/
    /*=======================================================*/

        

    /*********************************************************/
    /********************** PAGE LIVRES **********************/
    /*********************************************************/

    
    /**************************/
    /********* LIVRES *********/
    /**************************/
    function livresAll(){
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
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
            }
        }
        return $this->validAccess("books-all", $datas);
    }

    function addLivre(){
        $new = new \Projet\Models\BookModel();
        $data = $new->categoriesList();
        $datas = $data->fetchAll();
        return $this->validAccess("book-add", $datas);
    }

    function noCover(){
        // Default image if no book cover is submited
        return "no-cover.png";
    }

    function addLivrePost($data){
        $new = new \Projet\Models\BookModel();
        $datas = $new->addSingleBook($data);
        header('Location: indexAdmin.php?action=livres&status=success&from=add');
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

        $newSecond = new \Projet\Models\BookModel();
        $dataSecond = $newSecond->categoriesList();
        $datasSecond = $dataSecond->fetchAll();
        $datas = [
            "book" => $datasFirst,
            "genres" => $datasSecond
        ] ;
        return $this->validAccess("book-modify", $datas);
    }

    function modifyLivrePost($data){
        $new = new \Projet\Models\BookModel();
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

    /**************************/
    /********* GENRES *********/
    /**************************/
    function livresGenres(){
        $new = new \Projet\Models\BookModel();
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
        }
        return $this->validAccess("books-genres", $datas);
    }

    function noIcon(){
        return "no-icon.png";
    }

    function allGenre(){
        $new = new \Projet\Models\BookModel();
        $data = $new->allGenres();
        $datas = $data->fetchAll();
        return $this->validAccess("books-genres", $datas);
    }

    function genreAddPost($data){
        $new = new \Projet\Models\BookModel();
        $datas = $new->genreAddPost($data);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=add');
    }

    function genreModifyPost($data){
        $new = new \Projet\Models\BookModel(); 
        $datas = $new->genreModifyPost($data);
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=modify');
    }

    function deleteGenre($id){
        $new = new \Projet\Models\BookModel();
        $data = $new->deleteGenre($id);
        // $datas = $data->fetch();
        header('Location: indexAdmin.php?action=livres-genres&status=success&from=delete');
    }
    
    /*=======================================================*/
    /*=======================================================*/
    /*======================== FRONT ========================*/
    /*=======================================================*/
    /*=======================================================*/
    function home(){
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        return $this->viewFront("home", $datas);
    }

    function allBooks(){
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        return $this->viewFront("all-books", $datas);
    }

    function oneBook($id){
        $newFirst = new \Projet\Models\BookModel();
        $dataFirst = $newFirst->singleBook($id);
        $datasFirst = $dataFirst->fetch();

        $newSecond = new \Projet\Models\CommentModel();
        $dataSecond = $newSecond->allBookComments($id);
        $datasSecond = $dataSecond->fetchAll();
        $datas = [
            "book" => $datasFirst,
            "comments" => $datasSecond            
        ];
        return $this->viewFront("one-book", $datas);
    }

}