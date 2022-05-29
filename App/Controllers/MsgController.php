<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class MsgController extends Controller
{

    function contactPost($data)
    {
        $messages = new \Projet\Models\MsgModel();
        $msg = $messages->contactPost($data);
        
        if($msg != NULL){
            $userMessage = new SubmitMessage("success", 'Votre message a bien été envoyé !');
        } else {
            $userMessage = new SubmitMessage("error", "Votre message n'a pas pu être envoyé. Veuillez réessayer.");
        }
        $data["feedback"] = $userMessage->formatedMessage();
        return $this->viewFront("contact", $data);
    }

    function allMessages()
    {
        $pagination = $this->pagination("messages");
        $messages = new \Projet\Models\MsgModel();
        $msg = $messages->allMessagesPagination($pagination);
        $datas['messages'] = $msg->fetchAll();
        $datas['pages'] = $pagination['pages'];
        $datas['currentPage'] = $pagination['currentPage'];
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                $userMessage = new SubmitMessage("success", "Le message a bien été supprimé !");
                $data["feedback"] = $userMessage->formatedMessage();
        }}
        return $this->validAccess("messages", $datas);
    }

    function viewMessage($id)
    {
        $messages = new \Projet\Models\MsgModel();
        $oneMsg = $messages->singleMessage($id);
        $data = $oneMsg->fetch();
        if($data != false){
            return $this->validAccess("message-view", $data);
        }else{
            return $this->error404();
        }
    }

    function deleteMessage($id)
    {
        $messages = new \Projet\Models\MsgModel();
        $messages->deleteMessage($id);
        header('Location: indexAdmin.php?action=messages&status=success');
    }
    
}