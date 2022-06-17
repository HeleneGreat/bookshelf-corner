<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class BookController extends Controller
{

    // Get this book
    public function infoLivre($bookId)
    {
        $new = new \Projet\Models\BookModel();
        $data = $new->singleBook($bookId);
        $datas = $data->fetch();
        return $datas;
    }

    // All books page
    public function livresAll()
    {
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->livresMessage();
        }
        return $this->validAccess("books-all", $datas);
    }

    // Add one book page
    public function addLivre()
    {
        $new = new \Projet\Models\GenreModel();
        $data = $new->categoriesList();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            $userMessage = new SubmitMessage("", "");
            $datas["feedback"] = $userMessage->livresMessage();
        }
        return $this->validAccess("book-add", $datas);
    }

    // Default image if no book cover is submited
    public function noCover()
    {
        return "no-cover.png";
    }

    // Add one book form
    public function addLivrePost($Post, $Files, $admin){
        // Verify picture size is < 1 Mo
        if(isset($Files['picture']['size']) && $Files['picture']['size'] > 1000000){
            header('Location: indexAdmin.php?action=livres&status=error&&from=img');
            return;
        }
        $new = new \Projet\Models\BookModel();
        $data = [
            ':newTitle' => htmlspecialchars($Post['newTitle']),
            ':newAuthor' => htmlspecialchars($Post['newAuthor']),
            ':newYear_publication' => htmlspecialchars($Post['newYear_publication']),
            ':newGenre' => htmlspecialchars($Post['newGenre']),
            ':newCatchphrase' => htmlspecialchars($Post['newCatchphrase']),
            ':newContent' => htmlspecialchars($Post['newContent']),
            ':newNotation' => htmlspecialchars($Post['newNotation']),
            ":adminId" => $admin];
        // Verify book title is unique
        $newName = $this->checkForDuplicate("books", $data);
        if($newName == "nameOk"){
            $data[':newTitle'] = htmlspecialchars($Post['newTitle']);
        }
        // Add book to DB
        $new->addSingleBook($data);
        // Get book ID
        $book = new \Projet\Models\BookModel();
        $infoBook = $book->getId("books", "title", $data[':newTitle']);
        $bookId = $infoBook->fetch();
        // Add book cover
        $purpose = "book";
        $folder = "Books";
        $Files['picture']['name'] !== "" ? $fileName = $this->verifyFiles($purpose, $folder, $bookId['id']) : $fileName = $this->noCover();
        $data = [
            ":id" => $bookId['id'],
            ":picture" => $fileName];
        $this->updatePicture($data, 'books');
    }

    // This book page
    public function viewLivre($bookId)
    {
        $new = new \Projet\Models\BookModel();
        $data = $new->singleBook($bookId);
        $datas = $data->fetch();
        if($datas != false){
            return $this->validAccess("book-view", $datas);
        }else{
            return $this->error404();
        }
    }
  
    // Modify this book page
    public function modifyLivre($bookId)
    {
        $newFirst = new \Projet\Models\BookModel();
        $dataFirst = $newFirst->singleBook($bookId);
        $datasFirst = $dataFirst->fetch();
        if($datasFirst != false){
            $newSecond = new \Projet\Models\GenreModel();
            $dataSecond = $newSecond->categoriesList();
            $datasSecond = $dataSecond->fetchAll();
            $datas = [
                "book" => $datasFirst,
                "genres" => $datasSecond
                ] ;
            return $this->validAccess("book-modify", $datas);
        }else{
            return $this->error404();
        }
    }

    // Modify this book form
    public function modifyLivrePost($bookId, $Post, $Files){
        // Verify picture size is < 1 Mo
        if(isset($Files['picture']['size']) && $Files['picture']['size'] > 1000000){
            header('Location: indexAdmin.php?action=livres&status=error&&from=img');
            return;
        }
        // Add book cover
        $new = new \Projet\Models\BookModel();
        $purpose = "book";
        $folder = "Books";
        if(!empty($Files) && $Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $bookId);
        } else{
            $fileName = $this->infoLivre($bookId)['picture'];
        }
         // Verify book title is unique
        if(!empty($Post['newTitle'])){
            if($Post['newTitle'] != ""){
                $dataBook = [
                    'bookId' => $bookId,
                    'newTitle' => htmlspecialchars($Post['newTitle'])
                ];
                $newName = $this->checkForDuplicate("books", $dataBook, $bookId);
                if($newName == "nameOk"){
                    $bookName = htmlspecialchars($Post['newTitle']);
                }
            }
        } else{
           $bookName = $this->infoLivre($bookId)['title'];
        }
        // Update book
        $data = [
            ':id' => $bookId,
            ':newTitle' => $bookName,
            ':newAuthor' => htmlspecialchars($Post['newAuthor']),
            ':newYear_publication' => htmlspecialchars($Post['newYear_publication']),
            ':newGenre' => htmlspecialchars($Post['newGenre']),
            ':newCatchphrase' => htmlspecialchars($Post['newCatchphrase']),
            ':newContent' => htmlspecialchars($Post['newContent']),
            ':picture' => $fileName,
            ':newNotation' => htmlspecialchars($Post['newNotation'])
        ];
        $new->modifySingleBook($data);
        header('Location: indexAdmin.php?action=livres&status=success&from=modify');
    }

    // Delete this book
    public function deleteLivre($bookId)
    {
        $infoBook = $this->infoLivre($bookId);
        if($infoBook['picture'] != "no-cover.png"){
            unlink("./App/Public/Books/images/" . $infoBook['picture']);
        }
        $deletedBook = new \Projet\Models\BookModel();
        $deletedBook->deleteBook($bookId);
        header('Location: indexAdmin.php?action=livres&status=success&from=delete');
    }
    
    /**************************/
    /********* SLIDER *********/
    /**************************/
    // Book slider page ("Coups de coeur")
    public function livresSlider()
    {
        $new = new \Projet\Models\BookModel();
        $data = $new->allBooks();
        $datas = $data->fetchAll();
        if(isset($_GET['status'])){
            $userMessage = new SubmitMessage("", "");
            $datas["feedback"] = $userMessage->livresMessage();
        }
        return $this->validAccess("books-slider", $datas);
    }

    // Update list of books that are in the slider
    public function sliderSelection($data)
    {
        // First, all books in the DBB are set to slider = 0
        $allBooks = new \Projet\Models\BookModel();
        $sliderOff = $allBooks->sliderOff();
        // Second, the books selected in the slider form are set to 1
        $books = new \Projet\Models\BookModel();
        $oneBook = $books->sliderOn($data);
        header('Location: indexAdmin.php?action=livres-slider&status=success&from=slider');
    }
    
}