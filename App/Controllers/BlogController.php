<?php

namespace Projet\Controllers;

class BlogController extends Controller{

    function blogInfo($id){
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($id);
        $blog = $blogs->fetch();
        return $blog;
    }

    function blogParameters($id){
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($id);
        $blog = $blogs->fetch();
        $admin = new \Projet\Models\AdminModel();
        $thisAdmin = $admin->infoAdmin($_SESSION['mail']);
        $infoAdmin = $thisAdmin->fetch();
            if($infoAdmin['role'] === 1){
               return $this->viewAdmin("parameters", $blog); 
            }
            else{ echo "Vous n'avez pas accès à cette page"; }       
    }
    
    function blogModify($id){
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($id);
        $blog = $blogs->fetch();  
        $admin = new \Projet\Models\AdminModel();
        $thisAdmin = $admin->infoAdmin($_SESSION['mail']);
        $infoAdmin = $thisAdmin->fetch();
        if($infoAdmin['role'] === 1){
            return $this->viewAdmin("parameters-modify", $blog);
        }else{ echo "Vous n'avez pas accès à cette page"; }
    }
    
    function blogModifyPost($id, $Post, $Files){
        $user = new \Projet\Models\AdminModel();
        $purpose = "logo";
        $folder = "Admin";
        $blog = "blog";
        // check if there is a picture uploaded
        if($Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $blog);
        } else{
            $fileName = $this->blogInfo($id)['logo'];
        }
        // check is there is a new blog name
        if($Post['newBlog'] !== ""){
            $blogName = htmlspecialchars($Post['newBlog']);
        }
        else{
            $blogName = $this->blogInfo($id)['name'];
        }
        $data = [
            ':picture' => $fileName,
            ':newBlog' => $blogName
        ];
        $blogs = $user->blogModifyPost($data);
        header('Location: indexAdmin.php?action=blogParameters');
    }
}