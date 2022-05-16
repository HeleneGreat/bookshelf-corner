<?php

namespace Projet\Models;

class CommentModel extends Manager
{

    public function commentPost($data)
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('INSERT INTO comments (user_id, book_id, title, content) VALUES (:user_id, :book_id, :title, :content)');
        $req->execute($data);
        return $req;
    }

    public function countComments()
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM comments WHERE id');
        $req->execute();
        $result = $req->fetch();
        return $result;
    }

    // Every comment ever published
    public function allCommentsPagination($pagination)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, users.pseudo, users.picture, comments.title, comments.content
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id
            ORDER BY comments.created_at DESC
            LIMIT :firstItem, :perPage');
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    public function allComments()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id AS commentId, books.id AS bookId, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, users.pseudo, users.picture AS userPicture, comments.title, comments.content, books.picture AS bookPicture, books.title AS bookTitle
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id
            ORDER BY comments.id DESC');
        $req->execute();
        return $req;
    }

    // All comments related to THIS book article
    public function allBookComments($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, users.pseudo, users.picture, comments.title AS commentTitle, comments.content AS commentContent
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id 
            WHERE books.id = ?
            ORDER BY comments.id DESC');
        $req->execute(array($id));
        return $req;
    }

    public function singleComment($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, comments.title AS commentTitle, comments.content AS commentContent, users.pseudo, users.picture, users.mail, books.title AS bookTitle
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id
            WHERE comments.id = ?');
        $req->execute(array($id));
        return $req;
    }

    public function commentModifyPost($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'UPDATE comments
            SET title = :title, content = :content
            WHERE id = :id'
        );
        $req->execute($data); 
        return $req;
    }

    public function deleteComment($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }
    
    
}