<?php
namespace Projet\Models;


class UserModel extends Manager
{

    // Get all users
    public function allUsers()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, pseudo, mail, picture FROM users ORDER BY id DESC');
        $req->execute();
        return $req;
    }

    // Count all users
    public function countUsers()
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM users WHERE id');
        $req->execute();
        $result = $req->fetch();
        return $result;
    }

    // Information about this user
    public function infoUser($userId)
    {
        $bdd = $this->dbConnect();
        $infoUser = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM users WHERE id = ?');
        $infoUser->execute(array($userId));
        return $infoUser;
    }

    // Number of comments written by that user
    public function countUserComments($userId)
    {
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) AS nbComments FROM comments WHERE user_id = ?');
        $req->execute(array($userId));
        return $req;
    }

    // All comments written by that user
    public function allUserComments($userId, $pagination)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            "SELECT comments.id AS commentId, books.id AS bookId, DATE_FORMAT(comments.created_at, '%d %M %Y à %kh%i') AS created_at, comments.title AS commentTitle, comments.content AS commentContent, books.picture AS bookCover, books.title AS bookTitle
            FROM comments
            INNER JOIN books ON book_id = books.id
            INNER JOIN users ON user_id = users.id 
            WHERE users.id = {$userId}
            ORDER BY comments.created_at DESC
            LIMIT :firstItem, :perPage");
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    // Modify this user account
    public function modifyUserAccountPost($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE users SET pseudo = :newPseudo, mail = :newMail, mdp = :newUserPsw, picture = :picture WHERE id = :id');
        $req->execute($data);
        return $req;
    }

    /*******************************************************/
    /******************* USER CONNECTION *******************/
    /*******************************************************/
    // Add this user
    public static function createUser ($data)
    {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO users(pseudo, mail, mdp) VALUE(:pseudo, :mail, :mdp)');
        $req->execute($data);
        return $req;
    }

    // Information about user with this email
    public function infoConnexion($mail)
    {
        $bdd = $this->dbConnect();
        $infoUser = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM users WHERE mail = ?');
        $infoUser->execute(array($mail));
        return $infoUser;
    }


}