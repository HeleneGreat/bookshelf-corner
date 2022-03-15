<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./App/Public/admin/css/style.css">
</head>
<body>

<header id="bandeau-admin">
    <nav>
        <ul class="flex justify-between">
            <li><a class="btn" href="index.php">Voir mon site</a></li>
            <li><a class="btn" href="indexAdmin.php?action=myAccount">Mon compte</a></li>
            <li><a class="btn" href="indexAdmin.php?action=disconnect">Se déconnecter</a></li>
        </ul>
    </nav>
    
    
   
</header>

<main class="flex">

<?php include_once('./App/Views/admin/layouts/dashboard-sidebar.php'); ?>
    <div class="container">