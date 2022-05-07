<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $currentPageTitle; ?> | <?= $blog['name']; ?></title>
    <link rel="icon" type="image/x-icon" href="./App/Public/Front/images/puzzle-front.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./App/Public/front/css/style.css">    
</head>
<body>    
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
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=lieux">Lieux</a></li>
            <li><a href="index.php?action=livres">Livres</a></li>
            <li><a href="index.php?action=about">A propos</a></li>
            <li><a href="index.php?action=contact">Me contacter</a></li>
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
        <!-- Title + research + connexion -->

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
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=lieux">Lieux</a></li>
                    <li><a href="index.php?action=livres">Livres</a></li>
                    <li><a href="index.php?action=about">A propos</a></li>
                    <li><a href="index.php?action=contact">Me contacter</a></li>
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
