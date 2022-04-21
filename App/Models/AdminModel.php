<?php
namespace Projet\Models;


class AdminModel extends Manager{


    public function allAdmins(){
        $bdd = self::dbConnect();
        $req = $bdd->prepare('SELECT pseudo, mail FROM administrators');
        $req->execute();
        return $req;
    }
    
    /********************************************************/
    /******************* ADMIN CONNECTION *******************/
    /********************************************************/

    public static function createAdmin ($data){
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO administrators(pseudo, mail, mdp) VALUE(:pseudo, :mail, :mdp)');
        $req->execute($data);
        return $req;
    }

    public function infoAdmin($mail){
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture, role FROM administrators WHERE mail = ?');
        $infoAdmin->execute(array($mail));
        return $infoAdmin;
    }

    /*********************************************************/
    /********************* ADMIN ACCOUNT *********************/
    /*********************************************************/
    public function modifyAccountPost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE administrators SET pseudo = :newPseudo, mail = :newMail, mdp = :newAdminPsw, picture = :picture WHERE id = :id');
        $req->execute($data);
        return $req;
    }

    /*********************************************************/
    /******************** BLOG PARAMETERS ********************/
    /*********************************************************/
    public function blogModifyPost($data){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE website SET logo = :picture, name = :newBlog WHERE id = 1');
        $req->execute($data);
        return $req;
    }

    

}