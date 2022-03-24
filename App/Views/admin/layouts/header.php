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

<!-- Blur element when mobile nav is open -->
<div id="blur" class="display-none"></div>

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
    <div class="container">
        <h2>The Bookshelf Corner</h2>
        <h3>Espace admin</h3>
    </div>
    <div id="open-menu" class="menu-toggle"><i class="fas fa-bars"></i></div>
    <nav id="nav-xs">
        <div id="nav-profile">
            <img src="./App/Public/Admin/images/<?= $_SESSION['picture']; ?>" alt="">
            <p><?= $_SESSION['pseudo'] ;?></p>
        </div>
        <ul>
            <li><a href="index.php"><i class="fas fa-arrow-left"></i> Voir mon site</a></li>
            <li><a href="indexAdmin.php?action=dashboard"><i class="fas fa-chart-line"></i> Tableau de bord</a></li>
        </ul>
        <ul><h3>Gestion du site</h3>
            <li><a href="indexAdmin.php?action=livres"><i class="fas fa-book"></i> Livres</a></li>
            <li><a href="indexAdmin.php?action=messages"><i class="fas fa-envelope"></i> Messages</a></li>
            <li><a href="indexAdmin.php?action=comments"><i class="fas fa-comment"></i> Commentaires</a></li>
        </ul>
        <ul><h3>Profil</h3>
            <li><a href="indexAdmin.php?action=myAccount"><i class="fas fa-user"></i> Mon compte</a></li>
            <li><a class="disconnect" href="indexAdmin.php?action=disconnect"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
        </ul>
    </nav>
        
</header>

<main >


<?php include_once('./App/Views/admin/layouts/dashboard-sidebar.php'); ?>
    

