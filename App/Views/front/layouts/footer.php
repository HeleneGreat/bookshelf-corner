</main>

<footer id="foot">
    <section class="container flex justify-between">
        <div class="foot-list">
            <?php if(empty($_SESSION)){ ?>
                <h3>Créer un compte</h3>
                <p class="account">Pour profiter pleinement de nos lectures et participer à la vie du blog, créez un compte ou connectez-vous.</p>
                <a href="index.php?action=connexionUser" class="btn btn-secondary">Se connecter</a>
            <?php }elseif($_SESSION['role'] > 0){ ?>
                <h3>Espace administrateur</h3>
                <p class="account">Pour gérer l'ensemble du blog et publier de nouveaux contenus, rendez-vous sur votre tableau de bord.</p>
                <a class="btn btn-secondary" title="Espace administrateur" href="indexAdmin.php?action=dashboard">Espace admin</a>
            <?php }elseif($_SESSION['role'] == 0){ ?>
                <h3>Mon compte</h3>
                <p class="account">Rendez-vous sur votre tableau de bord pour gérer votre profil et vos commentaires.</p>
                <a class="btn btn-secondary" title="Mon compte" href="indexAdmin.php?action=userDashboard">Mon compte</a>
            <?php }; ?>
        </div>
        <div class="foot-list">
            <h3>Catégories</h3>
            <ul class="category">
            <?php foreach($genres as $genre){ ;?>
                <li>
                    <a href="index.php?action=livres&category=<?= $genre['id'] ;?>"><?= $genre['category'] ;?></a>
                </li>
            <?php } ;?>
            </ul>
        </div>
        <div class="foot-list">
            <h3>Nos dernières lectures</h3>
            <?php foreach($lastBooks as $lastBook){ ;?>
            <a href="index.php?action=un-livre&id=<?= $lastBook['id'] ;?>">
                <div class="last-books">
                    <img src="./App/Public/Books/images/<?= $lastBook['picture'] ;?>" alt="Couverture du livre <?= $lastBook['title'] ;?>">
                    <p class="title"><?= $lastBook['title'] ;?></p>
                    <p class="author"><?= $lastBook['author'] ;?></p>
                </div>
            </a>
            <?php } ;?>
        </div>
    </section>
    <p class="legals">HeleneGreat © 2022 - <a href="index.php?action=mentions-legales">Mentions légales</a> - <a href="indexAdmin.php">Espace administrateur</a></p>
</footer>


<script src="./App/Public/Front/js/navigation.js"></script>
<?php if ($currentPageTitle == "Bienvenue au coin des héros voyageurs"){ ?>
    <script src="./App/Public/Front/js/carousel.js"></script>
<?php } ?>

</body>
</html>