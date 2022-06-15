<?php

namespace Projet\Forms;

class SubmitMessage
{

    private string $code;
    private string $message;

    public function __construct(string $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    private function getCode()
    {
        return $this->code;
    }

    private function getMessage()
    {
        return $this->message;
    }

    public function formatedMessage()
    {
        return [
            "code" => $this->getCode(),
            "message" => $this->getMessage()
        ];
    }

    // create account + connexion messages
    public function accountMessage()
    {
        // Success
        if($_GET['from'] == "createUser"){
            $userMessage = new SubmitMessage("success", "Votre compte utilisateur a bien été créé !");
        }
        if($_GET['from'] == "createAdmin"){
            $userMessage = new SubmitMessage("success", "Le compte administrateur a bien été créé !");
        }
        // Error
        if($_GET['from'] == "connexionMail"){
            $userMessage = new SubmitMessage("error", "Aucun compte n'est associé à cette adresse mail !");
        }elseif($_GET['from'] == "connexionPsw"){
            $userMessage = new SubmitMessage("error", "Le mot de passe est erroné !");
        }elseif($_GET['from'] == "createAccountMail"){
            $userMessage = new SubmitMessage("error", "Un compte est déjà associé à ce mail !");
        }elseif($_GET['from'] == "createAccountPseudo"){
            $userMessage = new SubmitMessage("error", "Ce pseudo est déjà utilisé !");
        }elseif($_GET['from'] == "createAccountMailPseudo"){
            $userMessage = new SubmitMessage("error", "Ce mail et ce pseudo sont déjà utilisés !");
        }elseif($_GET['from'] == "img"){
            $userMessage = new SubmitMessage("error", "La taille limite autorisée pour les photos de profil est de 1 Mo");
        }

        $datas = $userMessage->formatedMessage();
        return $datas;
    }

    public function modifyAccountMessage()
    {
        // Error
        if ($_GET['from'] == "modifyMail")
        {
            $userMessage = new SubmitMessage("error", "Un compte est déjà associé à ce mail !");
        }
        elseif ($_GET['from'] == "modifyPseudo")
        {
            $userMessage = new SubmitMessage("error", "Ce pseudo est déjà utilisé !");
        }
        elseif ($_GET['from'] == "modifyMailPseudo")
        {
            $userMessage = new SubmitMessage("error", "Ce mail et ce pseudo sont déjà utilisés !");
        }
        elseif ($_GET['from'] == "modifyPsw")
        {
            $userMessage = new SubmitMessage("error", "Mot de passe incorrect !");
        }elseif($_GET['from'] == "img"){
            $userMessage = new SubmitMessage("error", "La taille limite autorisée pour les photos de profil est de 1 Mo");
        }
        // Success
        elseif($_GET['from'] == "modify") {
            $userMessage = new SubmitMessage("success", "Vos informations ont bien été modifiées !");
        }
        $datas = $userMessage->formatedMessage();
        return $datas;
    }

    public function genresMessage()
    {
        if ($_GET['from'] == "add")
        {
            $userMessage = new SubmitMessage("success", "La catégorie a bien été ajoutée !");
        }
        elseif ($_GET['from'] == "modify")
        {
            $userMessage = new SubmitMessage("success", "La catégorie a bien été modifiée !");
        }
        elseif ($_GET['from'] == "delete")
        {
            $userMessage = new SubmitMessage("success", "La catégorie a bien été supprimée !");
        }
        elseif ($_GET['from'] == "duplicate")
        {
            $userMessage = new SubmitMessage("error", "Cette catégorie existe déjà !");
        }
        $datas = $userMessage->formatedMessage();
        return $datas;
    }

    public function livresMessage()
    {
        if ($_GET['from'] == "add")
        {
            $userMessage = new SubmitMessage("success", "Le livre a bien été ajouté !");
        }
        elseif ($_GET['from'] == "modify")
        {
            $userMessage = new SubmitMessage("success", "Le livre a bien été modifié !");
        }
        elseif ($_GET['from'] == "delete")
        {
            $userMessage = new SubmitMessage("success", "Le livre a bien été supprimé !");
        }
        elseif ($_GET['from'] == "duplicate")
        {
            $userMessage = new SubmitMessage("error", "Ce livre existe déjà !");
        }
        elseif ($_GET['from'] == "slider")
        {
            $userMessage = new SubmitMessage("success", "Le slider a été mis à jour !");
        }
        elseif($_GET['from'] == "img"){
            $userMessage = new SubmitMessage("error", "La taille limite autorisée pour les photos de profil est de 1 Mo");
        }
        $datas = $userMessage->formatedMessage();
        return $datas;
    }

    public function commentsMessage()
    {
        if ($_GET['from'] == "admindelete")
        {
            $userMessage = new SubmitMessage("success", "Le commmentaire a bien été supprimé !");
        }
        elseif ($_GET['from'] == "deleteComment")
        {
            $userMessage = new SubmitMessage("success", "Votre commentaire a bien été supprimé !");
            $datas["feedback"] = $userMessage->formatedMessage();
        }
        elseif ($_GET['from'] == "modifyComment")
        {
            $userMessage = new SubmitMessage("success", "Votre commentaire a bien été mis à jour !");
            $datas["feedback"] = $userMessage->formatedMessage();
        }
        $datas = $userMessage->formatedMessage();
        return $datas;
    }
}