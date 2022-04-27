<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class CommentController extends Controller{

    function commentPost($data){
        $comment = new \Projet\Models\CommentModel();
        $comm = $comment->commentPost($data);
        if($comm != NULL){
            $userMessage = new SubmitMessage ("success", 'Votre commentaire a bien été publié !');
        } else {
            $userMessage = new SubmitMessage ("error", "Votre commentaire n'a pas pu être envoyé. Veuillez réessayer.");
        }
        $data["feedback"] = $userMessage->formatedMessage();
        header('Location: index.php?action=un-livre&id=' . $data[':book_id']);
    }

    function allComments(){
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->allComments();
        $data = $comm->fetchAll();
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                $userMessage = new SubmitMessage ("success", "Le commmentaire a bien été supprimé !");
                $data["feedback"] = $userMessage->formatedMessage();
        }}
        return $this->validAccess("comments", $data);
    }

    function viewComment($id){
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->singleComment($id);
        $data = $comm->fetch();
        return $this->validAccess("comment-view", $data);
    }

    function deleteComment($id){
        $comments = new \Projet\Models\CommentModel();
        $comments->deleteComment($id);
        header('Location: indexAdmin.php?action=comments&status=success');
    }
    
}