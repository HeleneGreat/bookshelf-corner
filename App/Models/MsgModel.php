<?php

namespace Projet\Models;

class MsgModel extends Manager{

    public function contactPost($data){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('INSERT INTO messages (gender, familyname, firstname, email, object, message) VALUES (:gender, :familyname, :firstname, :email, :object, :message)');
        $req->execute($data);
        return $req;
    }

    public function countMessages(){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('SELECT COUNT(id) FROM messages WHERE id');
        $req->execute();
        return $req;
    }

    public function allMessages(){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, gender, familyname, firstname, send_at, email, object, message FROM messages ORDER BY send_at DESC');
        $req->execute();
        return $req;
    }

    public function singleMessage($id){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, gender, familyname, firstname, send_at, email, object, message FROM messages where id = ?');
        $req->execute(array($id));
        return $req;
    }

    public function sendmessagePost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO messages(gender, familyname, firstname, email, object, message) VALUES (:gender, :familyname, :firstname, :email, :object, :message');
        $req->execute(array($data));
        return $req;
    }

    public function deleteMessage($id){
        $bdd =$this->dbConnect();
        $req = $bdd->prepare('DELETE FROM messages WHERE id = ?');
        $req->execute(array($id));
        return $req;
    }
    
    
}