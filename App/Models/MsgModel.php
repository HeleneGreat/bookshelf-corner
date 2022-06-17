<?php

namespace Projet\Models;

class MsgModel extends Manager
{

    /*********************************/
    /************* FRONT *************/
    /*********************************/
    // Contact form on the blog
    public function contactPost($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'INSERT INTO messages (gender, familyname, firstname, email, object, message)
            VALUES (:gender, :familyname, :firstname, :email, :object, :message)');
        $req->execute($data);
        return $req;
    }

    /**********************************/
    /************** BACK **************/
    /**********************************/
    // Count all messages
    public function countMessages()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM messages WHERE id');
        $req->execute();
        $result = $req->fetch();
        return $result;
    }

    // Get all messages
    public function allMessages()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, gender, familyname, firstname, DATE_FORMAT(send_at, "%d/%m/%Y à %kh%i") AS send_at, email, object, message
            FROM messages
            ORDER BY id DESC');
        $req->execute();
        return $req;
    }

    // Get all messages with pagination
    public function allMessagesPagination($pagination)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, gender, familyname, firstname, DATE_FORMAT(send_at, "%d/%m/%Y à %kh%i") AS send_at, email, object, message
            FROM messages
            ORDER BY id DESC
            LIMIT :firstItem, :perPage');
        $req->bindValue(':firstItem', $pagination[':firstItem'], $bdd::PARAM_INT);
        $req->bindValue(':perPage', $pagination[':perPage'], $bdd::PARAM_INT);
        $req->execute();
        return $req;
    }

    // Get this message
    public function singleMessage($messageId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare(
            'SELECT id, gender, familyname, firstname, DATE_FORMAT(send_at, "%d/%m/%Y à %kh%i") AS send_at, email, object, message
            FROM messages
            WHERE id = ?');
        $req->execute(array($messageId));
        return $req;
    }

    // Delete this message
    public function deleteMessage($messageId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM messages WHERE id = ?');
        $req->execute(array($messageId));
        return $req;
    }
    
    
}