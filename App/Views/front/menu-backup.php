<?php $currentPageTitle = "Menu de navigation";
include_once('./App/Views/front/layouts/head.php') ;?>

<!-- This page is only displayed when Javascript is not available as a way of showing the menu in small screens -->

<!-- HEADER -->
<header id="bandeau">
    <div class="align-items-center container">
        <div class="flex-xs">
            <!-- Logo -->
            <p><a href="index.php">
                <img class="logo container" src="./App/Public/Admin/images/<?= $blog['logo']; ?>" alt="">
            </a></p>
            <div class="head-lg flex col justify-between">
                <div class="title-lg flex justify-between">
                    <!-- Blog name -->
                    <a href="index.php"><h2><?= $blog['name']; ?></h2></a>
                    <!-- Account button (XL screens) -->
                    <div class="lg">
                        <?php if(empty($_SESSION)){ ?>
                            <a class="btn btn-secondary" href="index.php?action=connexionUser">Se Connecter</a>
                        <?php }elseif($_SESSION['role'] > 0){ ?>
                            <a class="btn btn-secondary" href="indexAdmin.php?action=dashboard">Espace admin</a>
                        <?php }elseif($_SESSION['role'] == 0){ ?>
                            <a class="btn btn-secondary" href="indexAdmin.php?action=userDashboard">Mon compte</a>
                        <?php }; ?>
                    </div>
                </div>
                <!-- Menu -->
                <nav id="nav-lg" class="show-menu">
                    <ul class="flex-lg justify-between">
                        <li><a href="index.php" <?php if(!isset($_GET['action'])){echo "class='active'";} ?>>Accueil</a></li>
                        <li class="submenu text-center"><a href="index.php?action=livres" <?php if(isset($_GET['action']) && $_GET['action'] == "livres"){echo "class='active'";} ?>>Livres</a>
                        <!-- Book categories sub-menu -->
                            <ul class="book-cat">
                                <?php foreach($genres as $genre){ ;?>
                                <li><a href="index.php?action=livres&category=<?= $genre['id'] ;?>"
                                <?php if(isset($_GET['category']) && $_GET['category'] == $genre['id']){echo "class='subactive'";} ?>><?= $genre['category'] ;?></a></li>
                                <?php } ;?>
                            </ul>
                        </li>
                        <li><a href="index.php?action=about" <?php if(isset($_GET['action']) && $_GET['action'] == "about"){echo "class='active'";} ?>>A propos</a></li>
                        <li><a href="index.php?action=contact" <?php if(isset($_GET['action']) && $_GET['action'] == "contact"){echo "class='active'";} ?>>Nous contacter</a></li>
                    <!-- Account button (XS screens) -->
                    <?php if(empty($_SESSION)){ ?>
                        <li class="mobile"><a class="btn btn-secondary" href="indexAdmin.php?action=connexionUser">Se Connecter</a></li>
                    <?php }elseif($_SESSION['role'] > 0){ ?>
                        <li class="mobile"><a class="btn btn-secondary" href="indexAdmin.php?action=dashboard">Espace admin</a></li>
                    <?php }elseif($_SESSION['role'] == 0){ ?>
                        <li class="mobile"><a class="btn btn-secondary" href="indexAdmin.php?action=userDashboard">Mon compte</a></li>
                    <?php }; ?>
                    </ul>
                    <!-- Close menu icon -->
                    <div>
                        <a id="close-menu" class="menu-toggle mobile" href="index.php"><i class="fa-solid fa-xmark"></i></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>