<?php $currentPageTitle = "Derniers livres lus"; ?>
<?php include ('layouts/header.php');?>


<section id="all-books" class="container bg-all">
    <h1>Les derniers livres que nous avons dévorés</h1>

    <div class="flex-md justify-between-md">
    <?php 
    foreach($datas['book'] as $book){ ?>
            <article id="book-card" class="center flex col justify-between">
                <h3 class="text-center"><?= 
                substr($book['title'], 0, 30); 
                if(strlen($book['title']) > 30){echo "[...]";}
                ?></h3>
                <p class="text-center">
                    <a href="index.php?action=un-livre&id=<?= $book['id'] ?>">
                        <img src="./App/Public/Books/images/<?= $book['picture']; ?>" alt="La couverture du roman <?= $book['title']; ?>">
                    </a>
                </p>
                <a href="index.php?action=un-livre&id=<?= $book['id'] ?>" class="center btn-book">Lire l'article</a>
            </article>
       
    <?php }; ?>
    </div>
</section>


<nav>
    <ul id="pagination">
        <!-- PREVIOUS PAGE -->
        <li class="<?= ($datas['currentPage'] == 1) ? "display-none" : "" ?>">
            <a href="index.php?action=livres&page=<?= $datas['currentPage'] - 1 ?>">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $datas['pages']; $page++): ?>
            <!-- ALL PAGES NUMBER -->
            <li class="<?= ($datas['currentPage'] == $page) ? "bold" : "" ?>">
                <a href="index.php?action=livres&page=<?= $page ?>" ><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- NEXT PAGE -->
            <li class="<?= ($datas['currentPage'] == $datas['pages']) ? "display-none" : "" ?>">
            <a href="index.php?action=livres&page=<?= $datas['currentPage'] + 1 ?>">Suivante</a>
        </li>
    </ul>
</nav>




<?php include ('layouts/footer.php')?>