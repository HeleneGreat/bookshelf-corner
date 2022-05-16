<?php

namespace Projet\Models;

class BlogModel extends Manager
{

    public function blogInfo($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT logo, name FROM website WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }

}