<?php

namespace Projet\Controllers;

use Projet\Forms\UserMessage;

class MsgController extends Controller{

    function contactPost($data){
        $messages = new \Projet\Models\MsgModel();
        $msg = $messages->contactPost($data);
        
        if($msg != NULL){
            $userMessage = new UserMessage ("success", 'Votre message a bien été envoyé !');
        } else {
            $userMessage = new UserMessage ("error", "Votre message n'a pas pu être envoyé. Veuillez réessayer.");
        }
        $data["feedback"] = $userMessage->formatedMessage();
        return $this->viewFront("contact", $data);
    }

    function allMessages(){
        $messages = new \Projet\Models\MsgModel();
        $msg = $messages->allMessages();
        $data = $msg->fetchAll();
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                $userMessage = new UserMessage ("success", "Le message a bien été supprimé !");
                $data["feedback"] = $userMessage->formatedMessage();
        }}
        return $this->validAccess("dashboard/messages", $data);
    }

    function viewMessage($id){
        $messages = new \Projet\Models\MsgModel();
        $oneMsg = $messages->singleMessage($id);
        $data = $oneMsg->fetch();
        return $this->validAccess("dashboard/message-view", $data);
    }

    function deleteMessage($id){
        $messages = new \Projet\Models\MsgModel();
        $messages->deleteMessage($id);
        header('Location: indexAdmin.php?action=messages&status=success');
    }
    
}