<?php

namespace Projet\Models;

class BlogModel extends Manager
{

    public function blogInfo($blogId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT logo, name FROM website WHERE id = ?');
        $req->execute(array($blogId));
        return $req;
    }

    public function blogModifyPost($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE website SET logo = :picture, name = :newBlog WHERE id = 1');
        $req->execute($data);
        return $req;
    }

}