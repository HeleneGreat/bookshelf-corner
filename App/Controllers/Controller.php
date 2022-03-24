<?php

namespace Projet\Controllers;

class Controller{

    function viewFront($viewName, $datas = null){
       
        include('./App/Views/front/' . $viewName . '.php');
    }

    function viewAdmin($viewName, $datas = null){
        include('./App/Views/admin/' . $viewName . '.php');
    }

}