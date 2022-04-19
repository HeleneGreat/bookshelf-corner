<?php

namespace Projet\Models;

class CommentModel extends Manager{

    public function commentPost($data){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('INSERT INTO comments (user_id, book_id, title, content) VALUES (:user_id, :book_id, :title, :content)');
        $req->execute($data);
        return $req;
    }

    public function countComments(){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM comments WHERE id');
        $req->execute();
        return $req;
    }

    public function allBookComments($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, users.pseudo, users.picture, comments.title, comments.content
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id 
            WHERE books.id = ?
            ORDER BY comments.created_at DESC');
        $req->execute(array($id));
        return $req;
    }

    public function singleComment($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, comments.title, comments.content, users.pseudo, users.picture, users.mail, books.title
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id
            WHERE comments.id = ?');
        $req->execute(array($id));
        return $req;
    }

    public function deleteComment($id){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }
    
    
}