<?php

namespace Projet\Models;

class CommentModel extends Manager
{

    /*********************************/
    /************* FRONT *************/
    /*********************************/
    // Comment form under each book article
    public function commentPost($data)
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare(
            'INSERT INTO comments (user_id, admin_id, book_id, title, content)
            VALUES (:user_id, :admin_id, :book_id, :title, :content)');
        $req->execute($data);
        return $req;
    }

    /**********************************/
    /************** BACK **************/
    /**********************************/
    // Count all comments
    public function countComments()
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM comments WHERE id');
        $req->execute();
        $result = $req->fetch();
        return $result;
    }

    // Count all comments from that User or Admin
    public function countAccountComments($accountId, $role_id)
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare("SELECT COUNT(id) AS nbComments FROM comments WHERE {$role_id} = ?");
        $req->execute(array($accountId));
        return $req;
    }

    // Every comment ever published
    public function allCommentsPagination($pagination)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, users.pseudo AS userPseudo, users.picture AS userPicture, administrators.pseudo AS adminPseudo, administrators.picture AS adminPicture, comments.title, comments.content
            FROM comments
            INNER JOIN books ON comments.book_id = books.id
            LEFT JOIN users ON comments.user_id = users.id
            LEFT JOIN administrators ON comments.admin_id = administrators.id
            ORDER BY comments.id DESC
            LIMIT :firstItem, :perPage');
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    // All comments without pagination
    public function allComments($userId = null)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT comments.id AS commentId, books.id AS bookId, DATE_FORMAT(comments.created_at, '%d %M %Y à %kh%i') AS created_at, users.pseudo AS userPseudo, users.picture AS userPicture, administrators.pseudo AS adminPseudo, administrators.picture AS adminPicture, comments.title, comments.content, books.picture AS bookPicture, books.title AS bookTitle
            FROM comments
            INNER JOIN books ON comments.book_id = books.id
            LEFT JOIN users ON comments.user_id = users.id
            LEFT JOIN administrators ON comments.admin_id = administrators.id
            {$userId}
            ORDER BY comments.id DESC");
        $req->execute();
        return $req;
    }

    // All comments written by that User or Admin
    public function allAccountComments($accountId, $table, $pagination)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT comments.id AS commentId, books.id AS bookId, DATE_FORMAT(comments.created_at, '%d %M %Y à %kh%i') AS created_at, comments.title AS commentTitle, comments.content AS commentContent, books.picture AS bookCover, books.title AS bookTitle
            FROM comments
            INNER JOIN books ON book_id = books.id
            WHERE {$table} = {$accountId}
            ORDER BY comments.created_at DESC
            LIMIT :firstItem, :perPage");
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    // All comments related to THIS book article
    public function allBookComments($bookId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, users.pseudo AS userPseudo, users.picture AS userPicture, administrators.pseudo AS adminPseudo, administrators.picture AS adminPicture, comments.title AS commentTitle, comments.content AS commentContent
            FROM (((comments
            INNER JOIN books ON comments.book_id = books.id)
            LEFT JOIN users ON comments.user_id = users.id)
            LEFT JOIN administrators ON comments.admin_id = administrators.id)
            WHERE books.id = ?
            ORDER BY comments.id DESC');
        $req->execute(array($bookId));
        return $req;
    }

    // One comment
    public function singleComment($commentId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT comments.id, DATE_FORMAT(comments.created_at, "%d %M %Y à %kh%i") AS created_at, comments.title AS commentTitle, comments.content AS commentContent, users.pseudo AS userPseudo, users.picture AS userPicture, administrators.pseudo AS adminPseudo, administrators.picture AS adminPicture, users.mail AS userMail, administrators.mail AS adminMail, books.title AS bookTitle
            FROM comments
            INNER JOIN books ON comments.book_id = books.id
            LEFT JOIN users ON comments.user_id = users.id
            LEFT JOIN administrators ON comments.admin_id = administrators.id
            WHERE comments.id = ?');
        $req->execute(array($commentId));
        return $req;
    }

    // Modify one comment
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

    // Delete one comment
    public function deleteComment($commentId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        return $req;
    }
    
    // Delete all comments about that book
    public function deleteBookComments($bookId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE book_id = ?');
        $req->execute(array($bookId));
        return $req;
    }

}