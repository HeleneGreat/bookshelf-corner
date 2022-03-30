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
        return $this->viewAdmin("dashboard/parameters", $blog);
    }
    
    function blogModify($id){
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($id);
        $blog = $blogs->fetch();
        return $this->viewAdmin("dashboard/parameters-modify", $blog);
    }

}