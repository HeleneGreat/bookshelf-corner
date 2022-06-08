<?php
namespace Projet\Models;


class AdminModel extends Manager
{
    public function allAdmins()
    {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT pseudo, mail, picture FROM administrators');
        $req->execute();
        return $req;
    }

    public function infoAdmin($adminId)
    {
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM administrators WHERE id = ?');
        $infoAdmin->execute(array($adminId));
        return $infoAdmin;
    }

    public function modifyAccountPost($data)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE administrators SET pseudo = :newPseudo, mail = :newMail, mdp = :newAdminPsw, picture = :picture WHERE id = :id');
        $req->execute($data);
        return $req;
    }    
    
    /********************************************************/
    /******************* ADMIN CONNECTION *******************/
    /********************************************************/
    public static function createAdmin ($data)
    {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO administrators(pseudo, mail, mdp) VALUE(:pseudo, :mail, :mdp)');
        $req->execute($data);
        return $req;
    }

    public function infoConnexion($mail)
    {
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM administrators WHERE mail = ?');
        $infoAdmin->execute(array($mail));
        return $infoAdmin;
    }

}