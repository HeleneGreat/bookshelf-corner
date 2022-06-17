<?php include_once('./App/Views/admin/layouts/head.php');
 ?>

<!-- Blur element when mobile nav is open -->
<div id="blur" class="display-none"></div>


<!-- HEADER -->
<header>
    <div id="bandeau-admin">
        <!-- Logo -->
        <div class="container">
            <h2><?= $blog['name']; ?></h2>
            <?php if($_SESSION['role'] > 0){ ?>
                <h3>Espace admin</h3>
            <?php }else{ ;?>
                <h3>Espace utilisateur</h3>
            <?php } ;?>
        </div>
        <!-- Open menu -->
        <div id="open-menu" class="menu-toggle mobile">
            <a title="Menu" href="indexAdmin.php?action=menu"><i class="fas fa-bars"></i></a>
        </div>
    </div>
</header>

<!-- The container div closes in the footer -->
<div class="container flex justify-between">
    <!-- Menu -->
    <nav id="nav-admin">
        <!-- User / Admin profile -->
        <div id="nav-profile">
            <img src="./App/Public/<?= $_SESSION['role'] > 0 ? "Admin" : "Users" ;?>/images/<?= $_SESSION['picture']; ?>" alt="Mon image de profil">
            <p><?= $_SESSION['pseudo'] ;?></p>
        </div>
        <ul>
            <!-- Back to the blog -->
            <li><a href="index.php" title="<?= $blog['name']; ?>"><i class="fas fa-arrow-left"></i> Retourner au blog</a></li>
            <!-- Dashboard -->
            <li><a href="indexAdmin.php?action=<?= $_SESSION['role'] == 0 ? "userDashboard" : "dashboard";?>" title="Tableau de bord"><i class="fas fa-chart-line"></i> Tableau de bord</a></li>
            <!-- IF USER : comments -->
            <?php if($_SESSION['role'] == 0){ ?>
                <li><a href="indexAdmin.php?action=comments-mine" title="Voir tous mes commentaires"><i class="fas fa-comment"></i> Commentaires</a></li>
            <?php } ?>
        </ul>
        <!-- IF ADMIN -->
        <?php if($_SESSION['role'] > 0){ ?>
        <h3>Gestion du site</h3>
        <ul>
            <!-- Books, categories and carousel management -->
            <li><a href="indexAdmin.php?action=livres" title="Articles publiés"><i class="fas fa-book"></i> Livres</a></li>
            <!-- Comments -->
            <li><a href="indexAdmin.php?action=comments" title="Commentaires des internautes"><i class="fas fa-comment"></i> Commentaires</a></li>
            <!-- Messages -->
            <li><a href="indexAdmin.php?action=messages" title="Messages reçus"><i class="fas fa-envelope"></i> Messages</a></li>
        </ul>
        <?php }; ?>
        <h3>Profil</h3>
        <ul>
            <!-- Account -->
            <li><a href="indexAdmin.php?action=<?= $_SESSION['role'] > 0 ? 'account' :'userAccount'; ?>" title="Paramètres du compte"><i class="fas fa-user"></i> Mon compte</a></li>
            <!-- IF SUPER ADMIN : blog parameters -->
        <?php if($_SESSION['role'] == 2){ ?>
            <li><a href="indexAdmin.php?action=blogParameters" title="Paramètres du blog"><i class="fa-solid fa-gear"></i> Paramètres du site</a></li>
        <?php };?>
            <!-- Disconnection -->
            <li><a class="disconnect" href="indexAdmin.php?action=<?= $_SESSION['role'] == 0 ? "userDisconnect" : "disconnect";?>" title="Se déconnecter"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
        </ul>
    </nav>

    <!-- MAIN -->
    <main >

    <!-- Button back to top of the page -->
    <!-- not shown on book pages, where there already is a fixed bottom button -->
    <?php if($_GET['action'] !== "livres" && $_GET['action'] !== "livresview"){;?>
        <div id="back-to-top">
            <a href="#bandeau-admin" title="Retour en haut de la page"><i class="fa-solid fa-circle-chevron-up"></i></a>
        </div>
    <?php } ;?>

    
    <!-- Div for error management -->
    <?php if(isset($datas['feedback'])) {;?>
        <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
    <?php }; ?>