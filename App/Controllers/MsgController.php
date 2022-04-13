<?php

namespace Projet\Controllers;

use UserMessage;

class MsgController extends Controller{

    function contactPost($data){
        $messages = new \Projet\Models\MsgModel();
        $msg = $messages->contactPost($data);
        
        if($msg != NULL){
            $userMessage = new UserMessage ("success", 'Votre message a bien été envoyé !');
        } else {
            $userMessage = new UserMessage ("error", "Votre message n'a pas pu être envoyé. Veuillez réessayer.");
        }
        return $this->viewFront("contact", $userMessage);
    }

    function allMessages(){
        $messages = new \Projet\Models\MsgModel();
        $msg = $messages->allMessages();
        $data = $msg->fetchAll();
        return $this->viewAdmin("dashboard/messages", $data);
    }

    function viewMessage($id){
        $messages = new \Projet\Models\MsgModel();
        $oneMsg = $messages->singleMessage($id);
        $data = $oneMsg->fetch();
        return $this->viewAdmin("dashboard/message-view", $data);
    }

    function deleteMessage($id){
        $messages = new \Projet\Models\MsgModel();
        $oneMessage = $messages->deleteMessage($id);
        $message = $oneMessage->fetch();
        header('Location: indexAdmin.php?action=messages');
    }
    
}