<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $currentPageTitle; ?> | The Bookshelf Corner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./App/Public/front/css/style.css">
    
</head>
<body>
<header id="bandeau">

<!-- NAV SMALL MOBILE -->
<div class="mobile container">
    <div class="title flex justify-between align-items-center">
        <p><img class="logo container" src="./App/Public/Front/images/bookshelf.png" alt=""></p>
        <h2 class="text-center">The Bookshelf Corner</h2>
    </div>

    <div>
        <img id="open-menu" class="menu-toggle" src="./App/Public/Front/images/70723_book_read_icon.png" alt="">
    </div>
    <nav id="nav-xs" class="flex">
        
        <ul class="flex col center">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=lieux">Lieux</a></li>
            <li><a href="index.php?action=livres">Livres</a></li>
            <li><a href="index.php?action=about">A propos</a></li>
            <li><a href="index.php?action=contact">Me contacter</a></li>
        </ul>
        <div class="flex justify-end">
            <img id="close-menu" class="menu-toggle" src="./App/Public/Front/images/70723_book_read_icon.png" alt="">
        </div>
    </nav>
</div>

<!-- NAV BIG SCREEN (lg) -->
<div class="lg align-items-center container">
    <div class="flex justify-between">
        <p><img class="logo container" src="./App/Public/Front/images/bookshelf.png" alt=""></p>
        <!-- Title + research + connexion -->

        <div class="head-lg flex col justify-between">
            <div class="title-lg flex justify-between">
                <h2>The Bookshelf Corner</h2>
                <div>
                    <input type="search" placeholder="Rechercher">
                    <button><a href="indexAdmin.php">Se connecter</a></button>
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

<?php if(isset($datas['feedback'])) {;?>
    <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>


