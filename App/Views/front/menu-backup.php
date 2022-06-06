<?php $currentPageTitle = "Menu de navigation"; ?>

<?php include_once('./App/Views/front/layouts/head.php') ;?>

<header id="bandeau">
    <div class="align-items-center container">
        <div class="flex-xs">
            <p><a href="index.php">
                <img class="logo container" src="./App/Public/Admin/images/<?= $blog['logo']; ?>" alt="">
            </a></p>
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
                <nav id="nav-lg" class="show-menu">
                    <ul class="flex-lg justify-between">
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
                    <div>
                        <a id="close-menu" class="menu-toggle mobile" href="index.php"><i class="fa-solid fa-xmark"></i></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>