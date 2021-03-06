<?php include_once('./App/Views/front/layouts/head.php') ;
?>
<!-- ancre for back to top of the page button -->
<div id="top-page"></div>

<!-- HEADER -->
<header id="bandeau">
    <!-- Open menu icon -->
    <div>
        <a id="open-menu" class="menu-toggle mobile" href="index.php?action=menu" title="Ouvrir le menu"><i class="fa-solid fa-bars"></i></a>
    </div>
    <div class="align-items-center container">
        <div class="flex-xs">
            <!-- Logo -->
            <p><a href="index.php" title="Accueil">
                <img class="logo container" src="./App/Public/Admin/images/<?= $blog['logo']; ?>" alt="Logo du blog litéraire. Passion des livres.">
            </a></p>
            <div class="head-lg flex col justify-between">
                <div class="title-lg flex justify-between">
                    <!-- Blog name -->
                    <a href="index.php" title="Accueil"><h2><?= $blog['name']; ?></h2></a>
                    <!-- Account button (XL screens) -->
                    <div class="lg">
                        <?php if(empty($_SESSION)){ ?>
                            <a class="btn btn-secondary" title="Se connecter" href="index.php?action=connexionUser">Se Connecter</a>
                        <?php }elseif($_SESSION['role'] > 0){ ?>
                            <a class="btn btn-secondary" title="Espace administrateur" href="indexAdmin.php?action=dashboard">Espace admin</a>
                        <?php }elseif($_SESSION['role'] == 0){ ?>
                            <a class="btn btn-secondary" title="Mon compte" href="indexAdmin.php?action=userDashboard">Mon compte</a>
                        <?php }; ?>
                    </div>
                </div>
                <!-- Menu -->
                <nav id="nav-lg" class="hide-menu">
                    <ul class="flex-lg justify-between">
                        <li><a href="index.php" title="Accueil" <?php if(!isset($_GET['action'])){echo "class='active'";} ?>>Accueil</a></li>
                        <li class="submenu text-center"><a href="index.php?action=livres" title="Tous les livres" <?php if(isset($_GET['action']) && $_GET['action'] == "livres"){echo "class='active'";} ?>>Livres</a>
                            <!-- Book categories sub-menu -->
                            <ul class="book-cat">
                                <?php foreach($genres as $genre){ ;?>
                                <li><a title="Catégorie" href="index.php?action=livres&category=<?= $genre['id'] ;?>"
                                <?php if(isset($_GET['category']) && $_GET['category'] == $genre['id']){echo "class='subactive'";} ?>><?= $genre['category'] ;?></a></li>
                                <?php } ;?>
                            </ul>
                        </li>
                        <li><a title="A propos" href="index.php?action=about" <?php if(isset($_GET['action']) && $_GET['action'] == "about"){echo "class='active'";} ?>>A propos</a></li>
                        <li><a title="Nous contacter" href="index.php?action=contact" <?php if(isset($_GET['action']) && $_GET['action'] == "contact"){echo "class='active'";} ?>>Nous contacter</a></li>
                        <!-- Account button (XS screens) -->
                        <?php if(empty($_SESSION)){ ?>
                            <li class="mobile"><a class="btn btn-secondary" title="Se connecter" href="index.php?action=connexionUser">Se Connecter</a></li>
                        <?php }elseif($_SESSION['role'] > 0){ ?>
                            <li class="mobile"><a class="btn btn-secondary" title="Espace administrateur" href="indexAdmin.php?action=dashboard">Espace admin</a></li>
                        <?php }elseif($_SESSION['role'] == 0){ ?>
                            <li class="mobile"><a class="btn btn-secondary" title="Mon compte" href="indexAdmin.php?action=userDashboard">Mon compte</a></li>
                        <?php }; ?>
                    </ul>
                    <!-- Close menu icon -->
                    <div>
                        <a id="close-menu" class="menu-toggle mobile" title="Fermer le menu" href=""><i class="fa-solid fa-xmark"></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- MAIN -->
<main>

    <!-- Button back to top of the page -->
    <div id="back-to-top">
        <a href="#top-page" title="Retour en haut de la page"><i class="fa-solid fa-circle-chevron-up"></i></a>
    </div>

    
<!-- Div for error management -->
<?php if(isset($datas['feedback']) && !isset($errorMngt)) {;?>
    <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

