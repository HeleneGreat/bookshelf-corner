<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class FrontController extends Controller
{
    public function home()
    {
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        return $this->viewFront("home", $datas);
    }

    public function allBooks($genreId)
    {
        $pagination = $this->pagination("books");
        $newBook = new \Projet\Models\BookModel();
        if($genreId == 0){
            $book = $newBook->allBooksPagination($pagination, $genreId);
        }else{
            $book = $newBook->allBooks($genreId);
        }
        $datas['book'] = $book->fetchAll();
        $newGenre = new \Projet\Models\GenreModel();
        $genre = $newGenre->infoGenre($genreId);
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

    public function oneBook($bookId)
    {
        $newFirst = new \Projet\Models\BookModel();
        $dataFirst = $newFirst->singleBook($bookId);
        $datasFirst = $dataFirst->fetch();
        if($datasFirst != false){
            $newSecond = new \Projet\Models\CommentModel();
            $dataSecond = $newSecond->allBookComments($bookId);
            $datasSecond = $dataSecond->fetchAll();
            $datas = [
                "book" => $datasFirst,
                "comments" => $datasSecond            
            ];
            if(isset($_GET['status']) && $_GET['from'] == "addComment"){
                $userMessage = new SubmitMessage("success", "Votre commentaire a bien été publié !");
                $datas["feedback"] = $userMessage->formatedMessage();
            }
            return $this->viewFront("one-book", $datas);
        }else{
            return $this->viewFront("error404");
        }
    }
    
    public function about()
    {
        $new = new \Projet\Models\AdminModel;
        $admins = $new->allAdmins();
        $allAdmins = $admins->fetchAll();
        return $this->viewFront("about", $allAdmins);
    }
    
    public function contact()
    {
        return $this->viewFront("contact");
    }
    
    public function legals()
    {
        return $this->viewFront("legals");
    }

    public function error()
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
    
    public function error404()
    {
        return $this->viewFront("error404");
    }

    // In case javascript is disabled, the mobile menu opens in a new page :
    public function menuNoJs()
    {
        return $this->viewFront("menu-backup");
    }
}