<?php include_once('./App/Views/front/layouts/head.php') ;?>

<header id="bandeau">
    <div>
        <img id="open-menu" class="menu-toggle mobile" src="./App/Public/Front/images/book-drawing.png" alt="">
    </div>
    <div class="align-items-center container">
        <div id="test" class="flex justify-between">
            <p><a href="index.php"><img class="logo container" src="./App/Public/Admin/images/<?= $blog['logo']; ?>" alt=""></a></p>
            <div class="head-lg flex col justify-between">
                <div class="title-lg flex justify-between">
                    <a href="index.php"><h2><?= $blog['name']; ?></h2></a>
                    <div class="lg">
                        <?php if(empty($_SESSION)){ ?>
                            <a class="btn btn-secondary" href="index.php?action=connexionUser">Se Connecter</a>
                        <?php }elseif($_SESSION['role'] > 0){ ?>
                            <a class="btn btn-secondary" href="indexAdmin.php?action=dashboard">Espace admin</a>
                        <?php }elseif($_SESSION['role'] === 0){ ?>
                            <a class="btn btn-secondary" href="indexAdmin.php?action=userDashboard">Mon compte</a>
                        <?php }; ?>
                    </div>
                </div>
                <nav id="nav-lg">
                    <ul class="flex justify-between">
                        <li><a href="index.php" <?php if(!isset($_GET['action'])){echo "class='active'";} ?>>Accueil</a></li>
                        <li class="submenu text-center"><a href="index.php?action=livres" <?php if(isset($_GET['action']) && $_GET['action'] == "livres"){echo "class='active'";} ?>>Livres</a>
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
                            <li class="mobile"><a class="btn btn-secondary" href="indexAdmin.php?action=connexionUser">Se Connecter</a></li>
                        <?php }elseif($_SESSION['role'] > 0){ ?>
                            <li class="mobile"><a class="btn btn-secondary" href="indexAdmin.php?action=dashboard">Espace admin</a></li>
                        <?php }elseif($_SESSION['role'] === 0){ ?>
                            <li class="mobile"><a class="btn btn-secondary" href="indexAdmin.php?action=userDashboard">Mon compte</a></li>
                        <?php }; ?>
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

    
<!-- Div for error management -->
<?php if(isset($datas['feedback'])) {;?>
    <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

