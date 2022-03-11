<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./App/Public/front/css/style.css">
</head>
<body>

<header id="bandeau">

<!-- NAV SMALL MOBILE -->
<div class="mobile container">
    <div class="title flex justify-between align-items-center">
        <p><img class="logo container" src="./App/Public/Front/images/bookshelf.png" alt=""></p>
        <h4 class="text-center">The Bookshelf Corner</h4>
    </div>

    <div>
        <img id="open-menu" class="menu-toggle" src="./App/Public/Front/images/70723_book_read_icon.png" alt="">
    </div>
    <nav id="nav-menu" class="flex">
        
        <ul class="flex col center">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">Lieux</a></li>
            <li><a href="#">Livres</a></li>
            <li><a href="#">A propos</a></li>
            <li><a href="#">Me contacter</a></li>
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
                    <button>Se connecter</button>
                </div>
            </div>

            <nav class="nav-lg">
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
