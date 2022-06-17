<?php
namespace Projet\Models;


class AdminModel extends Manager
{
    // Get all admins
    public function allAdmins()
    {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT pseudo, mail, picture FROM administrators');
        $req->execute();
        return $req;
    }

    // Information about this admin
    public function infoAdmin($adminId)
    {
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM administrators WHERE id = ?');
        $infoAdmin->execute(array($adminId));
        return $infoAdmin;
    }

    // Modify this admin account
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
    // Add this admin
    public static function createAdmin ($data)
    {
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO administrators(pseudo, mail, mdp) VALUE(:pseudo, :mail, :mdp)');
        $req->execute($data);
        return $req;
    }

    // Information about admin with this email
    public function infoConnexion($mail)
    {
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM administrators WHERE mail = ?');
        $infoAdmin->execute(array($mail));
        return $infoAdmin;
    }

}