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
               return $this->viewAdmin("dashboard/parameters", $blog); 
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
            return $this->viewAdmin("dashboard/parameters-modify", $blog);
        }else{ echo "Vous n'avez pas accès à cette page"; }
    }

}