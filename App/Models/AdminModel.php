<?php
namespace Projet\Models;


class AdminModel extends Manager{

    // ICI
    // public static function infoAdmins(){
    //     $bdd = self::dbConnect();
    //     $req = $bdd->prepare('SELECT * FROM administrators');
    //     $req->execute();
    //     $admins = [];
    //     foreach( $req->fetchAll() as $admin){
    //         array_push($admins, new self($admin));
    //     }
    //     return $admins;
    // }

    
    /********************************************************/
    /******************* ADMIN CONNECTION *******************/
    /********************************************************/

    public static function createAdmin ($pseudo, $mail, $mdp, $fileName){
        $bdd = self::dbConnect();
        $req = $bdd->prepare('INSERT INTO administrators(pseudo, mail, mdp, picture) VALUE(?, ?, ?, ?)');
        $req->execute(array($pseudo, $mail, $mdp, $fileName));
        return $req;
    }

    public function recupMdp($mail){
        $bdd = $this->dbConnect();
        $infoAdmin = $bdd->prepare('SELECT id, pseudo, mail, mdp, picture FROM administrators WHERE mail = ?');
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