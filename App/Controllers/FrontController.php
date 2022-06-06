<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class FrontController extends Controller
{
    function home()
    {
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        return $this->viewFront("home", $datas);
    }

    function allBooks($idGenre)
    {
        $pagination = $this->pagination("books");
        $newBook = new \Projet\Models\BookModel();
        $book = $newBook->allBooksPagination($pagination, $idGenre);
        $datas['book'] = $book->fetchAll();
        $newGenre = new \Projet\Models\GenreModel();
        $genre = $newGenre->infoGenre($idGenre);
        $datas['genre'] = $genre->fetch();
        if(!empty($datas['genre']) || !empty($datas['book'])){
            $datas['pages'] = $pagination['pages'];
            $datas['currentPage'] = $pagination['currentPage'];
            return $this->viewFront("all-books", $datas);
        }
        else{
            return $this->viewFront("error404");
        }
    }

    function oneBook($id)
    {
        $newFirst = new \Projet\Models\BookModel();
        $dataFirst = $newFirst->singleBook($id);
        $datasFirst = $dataFirst->fetch();
        if($datasFirst != false){
            $newSecond = new \Projet\Models\CommentModel();
            $dataSecond = $newSecond->allBookComments($id);
            $datasSecond = $dataSecond->fetchAll();
            $datas = [
                "book" => $datasFirst,
                "comments" => $datasSecond            
            ];
            if(isset($_GET['status'])){
                if($_GET['status'] == "success"){
                    if($_GET['from'] == "addComment"){
                        $userMessage = new SubmitMessage("success", "Votre commentaire a bien été publié !");
                        $datas["feedback"] = $userMessage->formatedMessage();
                    }
                }
            }
            return $this->viewFront("one-book", $datas);
        }else{
            return $this->viewFront("error404");
        }
    }
    
    function about()
    {
        $new = new \Projet\Models\AdminModel;
        $admins = $new->allAdmins();
        $allAdmins = $admins->fetchAll();
        return $this->viewFront("about", $allAdmins);
    }
    
    function contact()
    {
        return $this->viewFront("contact");
    }
    
    function error()
    {
        $datas = [];
        if(isset($_GET['status'])){
            if($_GET['from'] == "no-user-account"){
                $userMessage = new SubmitMessage("error", "Vous devez être connecté pour accéder à cet espace !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }   
        }
        return $this->viewFront("error", $datas);
    }
    
    function error404()
    {
        return $this->viewFront("error404");
    }

    // In case javascript is disabled, the mobile menu opens in a new page :
    function menuNoJs()
    {
        return $this->viewFront("menu-backup");
    }


}