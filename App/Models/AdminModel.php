<?php
namespace Projet\Models;


class AdminModel extends Manager{

    public static function infoAdmins(){
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT * FROM administrators');
        $req->execute();
        $admins = [];
        foreach( $req->fetchAll() as $admin){
            array_push($admins, new self($admin));
        }
        return $admins;
    }

    public static function createAdmin ($pseudo, $mail, $mdp){
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO administrators(pseudo, mail, mdp) VALUE(?, ?, ?)');
        $req->execute(array($pseudo, $mail, $mdp));
        return $req;
    }

    public function recupMdp($mail){
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT pseudo, mail, mdp FROM administrators WHERE mail = ?');
        $infoAdmin->execute(array($mail));
        return $infoAdmin;
    }

}