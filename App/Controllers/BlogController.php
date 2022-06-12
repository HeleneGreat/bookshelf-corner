<?php

namespace Projet\Controllers;

class BlogController extends Controller
{

    public function blogInfo($blogId)
    {
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($blogId);
        $blog = $blogs->fetch();
        return $blog;
    }

    public function blogParameters($blogId)
    {
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($blogId);
        $blog = $blogs->fetch();
        $admin = new \Projet\Models\AdminModel();
        $thisAdmin = $admin->infoAdmin($_SESSION['id']);
        $infoAdmin = $thisAdmin->fetch();
        if($infoAdmin['role'] == 2){
            return $this->viewAdmin("parameters", $blog); 
        }
        else{ echo "Vous n'avez pas accès à cette page"; }
    }

    public function blogModify($blogId)
    {
        $user = new \Projet\Models\BlogModel();
        $blogs = $user->blogInfo($blogId);
        $blog = $blogs->fetch();  
        $admin = new \Projet\Models\AdminModel();
        $thisAdmin = $admin->infoAdmin($_SESSION['id']);
        $infoAdmin = $thisAdmin->fetch();
        if($infoAdmin['role'] == 2){
            return $this->viewAdmin("parameters-modify", $blog);
        }else{
            echo "Vous n'avez pas accès à cette page"; }
    }

    public function blogModifyPost($blogId, $Post, $Files)
    {
        $new = new \Projet\Models\BlogModel();
        $purpose = "logo";
        $folder = "Admin";
        $blog = "blog";
        // check if there is a picture uploaded
        if($Files['picture']['name'] !== ""){
            $fileName = $this->verifyFiles($purpose, $folder, $blog);
        } else{
            $fileName = $this->blogInfo($blogId)['logo'];
        }
        // check is there is a new blog name
        if($Post['newBlog'] !== ""){
            $blogName = htmlspecialchars($Post['newBlog']);
        }
        else{
            $blogName = $this->blogInfo($blogId)['name'];
        }
        $data = [
            ':picture' => $fileName,
            ':newBlog' => $blogName
        ];
        $new->blogModifyPost($data);
        header('Location: indexAdmin.php?action=blogParameters');
    }

    // In case javascript is disabled, the mobile menu opens in a new page :
    public function menuNoJs()
    {
        return $this->validAccess("menu-backup");
    }
}