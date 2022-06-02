<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class CommentController extends Controller
{
    /*************************************/
    /*************** FRONT ***************/
    /*************************************/
    // Form a add a new comment under a book review
    function commentPost($idBook, $Post)
    {
        $comment = new \Projet\Models\CommentModel();
        $data = [
            ':user_id' => $_SESSION['id'],
            ':book_id' => $idBook,
            ':title' => htmlspecialchars(($Post['title'])),
            ':content' => htmlspecialchars(($Post['content']))
        ];
        if($_SESSION['role'] == 0)
        {
            $data[':user_id'] = $_SESSION['id'];
            $data[':admin_id'] = null;
        }
        elseif($_SESSION['role'] > 0)
        {
            $data[':admin_id'] = $_SESSION['id'];
            $data[':user_id'] = null;
        }
        $comment->commentPost($data);
        header('Location: index.php?action=un-livre&id=' . $data[':book_id']. '&status=success&from=addComment#feedback');
    }

    /*************************************/
    /*************** ADMIN ***************/
    /*************************************/
    // List all comments in the admin account
    function allComments()
    {
        $pagination = $this->pagination("comments");
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->allCommentsPagination($pagination);
        $datas['comments'] = $comm->fetchAll();
        $datas['pages'] = $pagination['pages'];
        $datas['currentPage'] = $pagination['currentPage'];
        if(isset($_GET['status']))
        {
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->commentsMessage();
        }
        return $this->validAccess("comments", $datas);
    }

    // For the admin to read this comment
    function viewComment($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->singleComment($id);
        $data = $comm->fetch();
        if($data != false)
        {
            return $this->validAccess("comment-view", $data);
        }
        else
        {
            return $this->error404();
        }
    }

    // For the admin to delete this user comment
    function deleteUserComment($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comments->deleteComment($id);
        header('Location: indexAdmin.php?action=comments&status=success&from=admindelete');
    }
    
    /*****************************************/
    /********* USER OR ADMIN ACCOUNT *********/
    /*****************************************/
    // All the comments added from that user or admin account
    function accountComments() {
        if($_SESSION['role'] == 0) {
            $table = "user_id";
        } else{
            $table = "admin_id";
        }
        $pagination = $this->pagination("comments");
        $new = new \Projet\Models\CommentModel();
        $allComment = $new->allAccountComments($_SESSION['id'], $table, $pagination);
        $allComments = $allComment->fetchAll();
        $countComments = new \Projet\Models\CommentModel();
        $nbrComment = $countComments->countAccountComments($_SESSION['id'], $table);
        $nbComments = $nbrComment->fetch();
        $datas = [
            'allComments' => $allComments,
            'nbComments' => $nbComments['nbComments'],
            'pages' => $pagination['pages'],
            'currentPage' => $pagination['currentPage']
        ];
        if(isset($_GET['status'])){
            $statusMessage = new SubmitMessage("","");
            $datas['feedback'] = $statusMessage->commentsMessage();
        } if($_SESSION['role'] == 0) {
            return $this->viewUser("comments-mine", $datas);
        } else{
            return $this->validAccess("comments-mine", $datas);
        }
    }

    // For the User or Admin to delete one of his comments
    function deleteComment($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comments->deleteComment($id);
        header('Location: indexAdmin.php?action=comments-mine&status=success&from=deleteComment');
    }

    // For the User or Admin to modify one of his comments
    function commentModify($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->singleComment($id);
        $data = $comm->fetch();
        if($data != false){
            if($_SESSION['role'] == 0)
            {
                return $this->viewUser("comment-modify", $data);
            }else
            {
                return $this->validAccess("comment-modify", $data);
            }
        }
        else
        {
            return $this->error404();
        }
    }

    // When a book is deleted, all comments related to it are also deleted
    function deleteBookComments($idBook)
    {
        $comments = new \Projet\Models\CommentModel();
        $comments->deleteBookComments($idBook);
    }

    // Save in DB the comment modify form
    function commentModifyPost($id, $Post)
    {
        $comments = new \Projet\Models\CommentModel();
        $data = [
            ':id' => $id,
            ':title' => htmlspecialchars($Post['title']),
            ':content' => htmlspecialchars($Post['content'])
        ];
        $comments->commentModifyPost($data);
        header('Location: indexAdmin.php?action=comments-mine&status=success&from=modifyComment');
    }

    
}