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

<!-- HEADER BIG SCREEN -->
<header id="bandeau-admin" class="lg">
    <nav>
        <ul class="flex justify-between">
            <li><a class="btn" href="index.php">Voir mon site</a></li>
            <li><a class="btn" href="indexAdmin.php?action=myAccount">Mon compte</a></li>
            <li><a class="btn" href="indexAdmin.php?action=disconnect">Se déconnecter</a></li>
        </ul>
    </nav>
</header>

<!-- HEADER MOBILE -->
<header id="bandeau-admin" class="mobile">
<!-- AJOUTER CLASS ACTIVE MOBILE -->
    <div id="open-menu" class="menu-toggle"><i class="fas fa-bars"></i></div>
    <nav id="nav-xs" class="flex">
        <ul class="flex col center">
            <li><a href="index.php">Voir mon site</a></li>
            <li><a href="indexAdmin.php?action=dashboard">Tableau de bord</a></li>
            <li><a href="indexAdmin.php?action=livres">Livres</a></li>
            <li><a href="indexAdmin.php?action=genres">Genres litéraires</a></li>
            <li><a href="indexAdmin.php?action=slider">Slider</a></li>
            <li><a href="indexAdmin.php?action=messages">Messages reçus</a></li>
            <li><a href="indexAdmin.php?action=comments">Commentaires</a></li>
            <li><a href="indexAdmin.php?action=myAccount">Mon compte</a></li>
            <li><a href="indexAdmin.php?action=disconnect">Se déconnecter</a></li>
        </ul>
    </nav>
    
    <div id="close-menu" class="menu-toggle display-none"><i class="fas fa-times"></i></div>
</header>

<main class="flex">

<!-- Quick link to add a new book -->
<a href="indexAdmin.php?action=livresadd">
    <div id="add-btn">
        <img src="./App/Public/Admin/images/book-light.png" alt="">
    </div>
</a>

<?php include_once('./App/Views/admin/layouts/dashboard-sidebar.php'); ?>
    <div class="container">