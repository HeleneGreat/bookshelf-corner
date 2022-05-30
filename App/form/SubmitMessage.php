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

    public function modifyAccountMessage()
    {
        if ($_GET['status'] == "error") {
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
            }
        }
        if ($_GET['status'] == "success") {
            if ($_GET['from'] == "modify") {
                $userMessage = new SubmitMessage("success", "Vos informations ont bien été modifiées !");
            }
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