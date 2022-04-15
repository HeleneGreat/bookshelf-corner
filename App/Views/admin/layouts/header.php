<?php include_once('./App/Views/admin/layouts/head.php'); ?>

<!-- Blur element when mobile nav is open -->
<div id="blur" class="display-none"></div>


<!-- HEADER -->
<header>
    <div id="bandeau-admin">
        <div class="container">
            <h2>The Bookshelf Corner</h2>
            <h3>Espace admin</h3>
        </div>
        <div id="open-menu" class="menu-toggle mobile"><i class="fas fa-bars"></i></div>
    </div>
</header>

<div class="container flex justify-between">
    <nav id="nav-admin">
        <div id="nav-profile">
            <img src="./App/Public/Admin/images/<?= $_SESSION['picture']; ?>" alt="">
            <p><?= $_SESSION['pseudo'] ;?></p>
        </div>
        <ul>
            <li><a href="index.php" title="The Bookshelf Corner"><i class="fas fa-arrow-left"></i> Voir mon site</a></li>
            <li><a href="indexAdmin.php?action=dashboard" title="Tableau de bord"><i class="fas fa-chart-line"></i> Tableau de bord</a></li>
        </ul>
        <ul><h3>Gestion du site</h3>
            <li><a href="indexAdmin.php?action=livres" title="Articles publiés"><i class="fas fa-book"></i> Livres</a></li>
            <li><a href="indexAdmin.php?action=comments" title="Commentaires des internautes"><i class="fas fa-comment"></i> Commentaires</a></li>
            <li><a href="indexAdmin.php?action=messages" title="Messages reçus"><i class="fas fa-envelope"></i> Messages</a></li>
        </ul>
        <ul><h3>Profil</h3>
            <li><a href="indexAdmin.php?action=account" title="Paramètres du compte"><i class="fas fa-user"></i> Mon compte</a></li>
            <li><a href="indexAdmin.php?action=blogParameters" title="Paramètres du blog"><i class="fa-solid fa-gear"></i> Paramètres du site</a></li>
            <li><a class="disconnect" href="indexAdmin.php?action=disconnect" title="Se déconnecter"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
        </ul>
    </nav>

    <main >

   
 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
        <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>