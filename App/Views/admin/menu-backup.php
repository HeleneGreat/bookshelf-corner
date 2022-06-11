<?php $currentPageTitle = "Menu de navigation"; ?>

<?php include_once('./App/Views/admin/layouts/head.php') ;?>


<div class="container flex justify-between">
    <nav id="nav-admin" class="no-js">
        <div id="nav-profile">
            <img src="./App/Public/<?= $_SESSION['role'] > 0 ? "Admin" : "Users" ;?>/images/<?= $_SESSION['picture']; ?>" alt="Mon image de profil">
            <p><?= $_SESSION['pseudo'] ;?></p>
            <a class="exit" href="indexAdmin.php" title="Revenir au tableau de bord"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <ul>
            <li><a href="index.php" title="<?= $blog['name']; ?>"><i class="fas fa-arrow-left"></i> Retourner au blog</a></li>
            <li><a href="indexAdmin.php?action=<?= $_SESSION['role'] === 0 ? "userDashboard" : "dashboard";?>" title="Tableau de bord"><i class="fas fa-chart-line"></i> Tableau de bord</a></li>
            <?php if($_SESSION['role'] == 0){ ?>
                <li><a href="indexAdmin.php?action=comments-mine" title="Voir tous mes commentaires"><i class="fas fa-comment"></i> Commentaires</a></li>
            <?php } ?>
        </ul>
        <?php if($_SESSION['role'] > 0){ ?>
        <h3>Gestion du site</h3>
        <ul>
            <li><a href="indexAdmin.php?action=livres" title="Articles publiés"><i class="fas fa-book"></i> Livres</a></li>
            <li><a href="indexAdmin.php?action=comments" title="Commentaires des internautes"><i class="fas fa-comment"></i> Commentaires</a></li>
            <li><a href="indexAdmin.php?action=messages" title="Messages reçus"><i class="fas fa-envelope"></i> Messages</a></li>
        </ul>
        <?php }; ?>
        <h3>Profil</h3>
        <ul>
            <li><a href="indexAdmin.php?action=<?= $_SESSION['role'] > 0 ? 'account' :'userAccount'; ?>" title="Paramètres du compte"><i class="fas fa-user"></i> Mon compte</a></li>
        <?php if($_SESSION['role'] === 2){ ?>
            <li><a href="indexAdmin.php?action=blogParameters" title="Paramètres du blog"><i class="fa-solid fa-gear"></i> Paramètres du site</a></li>
        <?php };?>
            <li><a class="disconnect" href="indexAdmin.php?action=<?= $_SESSION['role'] === 0 ? "userDisconnect" : "disconnect";?>" title="Se déconnecter"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
        </ul>
    </nav>
