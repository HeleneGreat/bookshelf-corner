<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class MsgController extends Controller
{

    /*************************************/
    /*************** FRONT ***************/
    /*************************************/
    // Contact form
    public function contactPost($data)
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

    /************************************/
    /*************** BACK ***************/
    /************************************/
    // All messages page
    public function allMessages()
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

    // This message page
    public function viewMessage($messageId)
    {
        $messages = new \Projet\Models\MsgModel();
        $oneMsg = $messages->singleMessage($messageId);
        $data = $oneMsg->fetch();
        if($data != false){
            return $this->validAccess("message-view", $data);
        }else{
            return $this->error404();
        }
    }

    // Delete this message
    public function deleteMessage($messageId)
    {
        $messages = new \Projet\Models\MsgModel();
        $messages->deleteMessage($messageId);
        header('Location: indexAdmin.php?action=messages&status=success');
    }
    
}