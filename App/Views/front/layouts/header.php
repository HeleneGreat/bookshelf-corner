<?php include_once('./App/Views/front/layouts/head.php') ;?>

<header id="bandeau">
<!-- NAV SMALL MOBILE -->
<div class="mobile container">
    <div class="title flex justify-between align-items-center">
        <p><img class="logo container" src="./App/Public/Admin/images/<?= $blog['logo']; ?>" alt=""></p>
        <h2 class="text-center"><?= $blog['name']; ?></h2>
    </div>

    <div>
        <img id="open-menu" class="menu-toggle" src="./App/Public/Front/images/book-drawing.png" alt="">
    </div>
    <nav id="nav-xs" class="flex">
        <ul class="flex col center">
            <li><a href="index.php" <?php if(!isset($_GET['action'])){echo "class='active'";} ?>>Accueil</a></li>
            <li><a href="index.php?action=livres" <?php if(isset($_GET['action']) && $_GET['action'] == "livres"){echo "class='active'";} ?>>Livres</a>
                <ul class="book-cat">
                    <?php foreach($genres as $genre){ ;?>
                    <li><a href="index.php?action=livres&category=<?= $genre['id'] ;?>"
                    <?php if(isset($_GET['category']) && $_GET['category'] == $genre['id']){echo "class='subactive'";} ?>><?= $genre['category'] ;?></a></li>
                    <?php } ;?>
                </ul>
            </li>
            <li><a href="index.php?action=about" <?php if(isset($_GET['action']) && $_GET['action'] == "about"){echo "class='active'";} ?>>A propos</a></li>
            <li><a href="index.php?action=contact" <?php if(isset($_GET['action']) && $_GET['action'] == "contact"){echo "class='active'";} ?>>Nous contacter</a></li>
            <?php if(empty($_SESSION)){ ?>
                <li><a href="indexAdmin.php?action=connexionUser">Se Connecter</a></li>
            <?php }elseif($_SESSION['role'] > 0){ ?>
                <li><a href="indexAdmin.php?action=dashboard">Espace admin</a></li>
            <?php }elseif($_SESSION['role'] === 0){ ?>
                <li><a href="indexAdmin.php?action=userDashboard">Mon compte</a></li>
            <?php }; ?>
        </ul>
        <div class="flex justify-end">
            <img id="close-menu" class="menu-toggle" src="./App/Public/Front/images/book-drawing.png" alt="">
        </div>
    </nav>
</div>

<!-- NAV BIG SCREEN (lg) -->
<div class="lg align-items-center container">
    <div class="flex justify-between">
        <p><img class="logo container" src="./App/Public/Admin/images/<?= $blog['logo']; ?>" alt=""></p>
        <div class="head-lg flex col justify-between">
            <div class="title-lg flex justify-between">
                <h2><?= $blog['name']; ?></h2>
                <div>
                <?php if(empty($_SESSION)){ ?>
                    <button><a href="index.php?action=connexionUser">Se Connecter</a></button>
                <?php }elseif($_SESSION['role'] > 0){ ?>
                    <button><a href="indexAdmin.php?action=dashboard">Espace admin</a></button>
                <?php }elseif($_SESSION['role'] === 0){ ?>
                    <button><a href="indexAdmin.php?action=userDashboard">Mon compte</a></button>
                <?php }; ?>
                </div>
            </div>

            <nav id="nav-lg">
                <ul class="flex justify-between">
                    <li class=""><a href="index.php" <?php if(!isset($_GET['action'])){echo "class='active'";} ?>>Accueil</a></li>
                    <li class="submenu text-center"><a href="index.php?action=livres" <?php if(isset($_GET['action']) && $_GET['action'] == "livres"){echo "class='active'";} ?>>Livres</a>
                        <ul class="book-cat">
                            <?php foreach($genres as $genre){ ;?>
                            <li><a href="index.php?action=livres&category=<?= $genre['id'] ;?>"
                            <?php if(isset($_GET['category']) && $_GET['category'] == $genre['id']){echo "class='subactive'";} ?>><?= $genre['category'] ;?></a></li>
                            <?php } ;?>
                        </ul>
                    </li>
                    <li><a href="index.php?action=about"
                        <?php if(isset($_GET['action']) && $_GET['action'] == "about"){echo "class='active'";} ?>>A propos</a></li>
                    <li><a href="index.php?action=contact" 
                        <?php if(isset($_GET['action']) && $_GET['action'] == "contact"){echo "class='active'";} ?>>Nous contacter</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</header>

<main>

    <!-- Button back to top of the page -->
    <div id="back-to-top">
        <a href="#bandeau" title="Retour en haut de la page"><i class="fa-solid fa-circle-chevron-up"></i></a>
    </div>

