<?php $currentPageTitle = "Derniers livres lus"; ?>
<?php include ('layouts/header.php')?>


<section id="all-books" class="container bg-all">
    <h1>Les derniers livres que nous avons dévorés</h1>

    <div class="flex-md justify-between-md">
    <?php foreach($books as $book){ ?>
        <a href="index.php?action=un-livre&id=<?= $book['id'] ?>">
            <article id="book-card" class="center">
                <h3 class="text-center"><?= $book['title']; ?></h3>
                <h4 class="text-center"><?= $book['author']; ?></h4>
                <p class="center text-center"><img src="./App/Public/Books/images/<?= $book['picture']; ?>" alt="La couverture du roman <?= $book['title']; ?>"></p>
                <div class="flex justify-center">
                    <button>Lire l'article</button>
                </div>
                
            </article>
        </a>

    <?php }; ?>
    </div>
</section>





<?php include ('layouts/footer.php')?>