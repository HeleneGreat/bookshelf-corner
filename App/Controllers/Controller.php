<?php

namespace Projet\Controllers;

class Controller
{

    public function viewFront($viewName, $datas = null)
    {
        $newBlog = new \Projet\Models\BlogModel();
        $blogs = $newBlog->blogInfo(1);
        $blog = $blogs->fetch();
        $newGenre = new \Projet\Models\GenreModel();
        $allGenres = $newGenre->allGenres();
        $genres = $allGenres->fetchAll();
        $newBook = new \Projet\Models\BookModel();
        $lastThreeBooks = $newBook->lastBooks(3);
        $lastBooks = $lastThreeBooks->fetchAll();
        include('./App/Views/front/' . $viewName . '.php');
    }

    protected function viewUser($viewName, $datas = null)
    {
        $new = new \Projet\Models\BlogModel();
        $blogs = $new->blogInfo(1);
        $blog = $blogs->fetch();
        if (!empty($_SESSION) && $_SESSION['role'] === 0){
            include('./App/Views/admin/' . $viewName . '.php');
        }else{
            header('Location: index.php?action=error&status=error&from=no-user-account');
        }
    }

    protected function viewAdmin($viewName, $datas = null)
    {
        $new = new \Projet\Models\BlogModel();
        $blogs = $new->blogInfo(1);
        $blog = $blogs->fetch();      
        include('./App/Views/admin/' . $viewName . '.php');
    }

    protected function validAccess($path, $data = [])
    {
        if (!empty($_SESSION) && $_SESSION['role'] > 0){
            if($_SESSION['mail'] != null){
                return $this->viewAdmin($path, $data);
            }else{
                header('Location: indexAdmin.php?action=error&status=error&from=no-access');
            }
        }else{
            header('Location: indexAdmin.php?action=error&status=error&from=no-access');
        }
    }

    public function verifyFiles($purpose, $folder, $id)
    {
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
        // Max size accepted in octet (2000000 octets = 2 Mo)
        $maxSize = 2000000;
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
            // Files are renamed like this example : "admin_22.png"
            $fileName = filter_var($purpose . "_" . $id . "." . $extension);
            // Files are saved in the App folders
            move_uploaded_file($tmpName, "./App/Public/$folder/images/" . $fileName);
            return $fileName;
        }
        else { echo "Une erreur est survenue. Vous devez ajouter une image de profil. La taille du fichier est limitée à 2 Mo. "; }
    }

    // After row creation in BDD, update the BDD with the picture name
    public function updatePicture($data, $table)
    {
        if($table === 'administrators'){
            $new = new \Projet\Models\AdminModel();
            $datas = $new->updatePicture($data, $table); 
            header('Location: indexAdmin.php?action=connexionAdmin&status=success&from=create');
        }
        if($table === 'books'){
            $new = new \Projet\Models\BookModel(); 
            $datas = $new->updatePicture($data, $table); 
            header('Location: indexAdmin.php?action=livres&status=success&from=add');
        }
        if($table === 'genres'){
            $new = new \Projet\Models\BookModel(); 
            $datas = $new->updatePicture($data, $table);
            header('Location: indexAdmin.php?action=livres-genres&status=success&from=add');
        }       
        if($table === 'users'){
            $new = new \Projet\Models\UserModel(); 
            $new->updatePicture($data, $table);
            header('Location: index.php?action=connexionUser&status=success&from=createUser');
        }       
    }

    public function checkForDuplicate($table, $newdata){
        if($table == "administrators" || $table == "users"){
            if($table == "administrators"){
                $new = new \Projet\Models\AdminModel();
            }elseif($table == "users"){
                $new = new \Projet\Models\UserModel();
            }
            if(str_contains($newdata, "@")){
                $column = "mail";
            }
            if(!str_contains($newdata, "@")){
                $column = "pseudo";
            }
        }elseif($table == "books"){
            $new = new \Projet\Models\BookModel();
            $column = 'title';
            $redirection = "livres";
        }elseif($table == "genres"){
            $new = new \Projet\Models\BookModel();
            $column = 'category';
            $redirection = "livres-genres";
        }else{
            echo "Un des arguments a été mal enregistré";
        }
        $data = $new->checkForDuplicate($table, $column, $newdata);
        $result = $data->fetch();
        if(empty($result) || $result == false || (!empty($_SESSION)) && ($result['id'] == $_SESSION['id'])){
            return "nameOk";
        }elseif($table == "books" || $table == "genres"){
            header('Location: indexAdmin.php?action=' . $redirection . '&status=error&from=duplicate');
        }
    }

    public function pagination($table)
    {
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }
        if($table === "books"){
            $new = new \Projet\Models\BookModel();
            $perPage = 8;
            $totalItems = $new->countBooks();
            $totalItems = $totalItems['COUNT(id)'];
        }elseif($table === "messages"){
            $new = new \Projet\Models\MsgModel();
            $perPage = 15;
            $totalItems = $new->countItems($table);
        }elseif($table === "comments" && $_SESSION['role'] > 0){
            $new = new \Projet\Models\CommentModel();
            $perPage = 15;
            $totalItems = $new->countComments($table);
            $totalItems = $totalItems['COUNT(id)'];
        }elseif($table === "comments" && $_SESSION['role'] == 0){
            $new = new \Projet\Models\UserModel();
            $perPage = 10;
            $totalItem = $new->countUserComments($_SESSION['id']);
            $totalItems = $totalItem->fetch();
            $totalItems = $totalItems['nbComments'];
        }
        // Get number of pages
        $pages = ceil($totalItems / $perPage);
        // Get first page item
        $firstItem = ($currentPage * $perPage) - $perPage;
        $datas = [
            'currentPage' => $currentPage,
            'pages' => $pages,
            ':firstItem' => $firstItem,
            ':perPage' => $perPage,
            ':totalItems' => $totalItems
        ];
        return $datas;
    }

    public function error404()
    {
        if(!empty($_SESSION) && $_SESSION['role'] === 0){
            return $this->viewUser("error404");
        }else{
            return $this->viewAdmin("error404");
        }
    }

}