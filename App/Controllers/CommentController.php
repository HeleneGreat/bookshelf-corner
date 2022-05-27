<?php

namespace Projet\Controllers;

use Projet\Forms\SubmitMessage;

class CommentController extends Controller
{

    function commentPost($idBook, $Post)
    {
        $comment = new \Projet\Models\CommentModel();
        $data = [
            ':user_id' => $_SESSION['id'],
            ':book_id' => $idBook,
            ':title' => htmlspecialchars(($Post['title'])),
            ':content' => htmlspecialchars(($Post['content']))
        ];
        if($_SESSION['role'] == 0){
            $data[':user_id'] = $_SESSION['id'];
            $data[':admin_id'] = null;
        } elseif($_SESSION['role'] > 0){
            $data[':admin_id'] = $_SESSION['id'];
            $data[':user_id'] = null;
        }
        $comment->commentPost($data);
        header('Location: index.php?action=un-livre&id=' . $data[':book_id']. '&status=success&from=addComment#feedback');
    }

    function allComments()
    {
        $pagination = $this->pagination("comments");
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->allCommentsPagination($pagination);
        $datas['comments'] = $comm->fetchAll();
        $datas['pages'] = $pagination['pages'];
        $datas['currentPage'] = $pagination['currentPage'];
        if(isset($_GET['status'])){
            if($_GET['status'] == "success"){
                $userMessage = new SubmitMessage ("success", "Le commmentaire a bien été supprimé !");
                $data["feedback"] = $userMessage->formatedMessage();
        }}
        return $this->validAccess("comments", $datas);
    }

    function viewComment($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->singleComment($id);
        $data = $comm->fetch();
        if($data != false){
            return $this->validAccess("comment-view", $data);
        }else{
            return $this->error404();
        }
    }

    // For the admin to delete any comment
    function deleteComment($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comments->deleteComment($id);
        header('Location: indexAdmin.php?action=comments&status=success');
    }
           
    /******************************/
    /************ USER ************/
    /******************************/
    // For the user to delete one of his comments
    function userDeleteComment($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comments->deleteComment($id);
        header('Location: indexAdmin.php?action=userDashboard&status=success&from=deleteComment');
    }

    // For the user to modify one of his comments
    function commentModify($id)
    {
        $comments = new \Projet\Models\CommentModel();
        $comm = $comments->singleComment($id);
        $data = $comm->fetch();
        if($data != false){
            return $this->viewUser("user-comment-modify", $data);
        }else{
            return $this->error404();
        }
    }

    function commentModifyPost($id, $Post)
    {
        $comments = new \Projet\Models\CommentModel();
        $data = [
            ':id' => $id,
            ':title' => htmlspecialchars($Post['title']),
            ':content' => htmlspecialchars($Post['content'])
        ];
        $comm = $comments->commentModifyPost($data);
        header('Location: indexAdmin.php?action=userDashboard&status=success&from=modifyComment');
    }

    
}