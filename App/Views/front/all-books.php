<?php $currentPageTitle = "Derniers livres lus"; ?>
<?php include ('layouts/header.php')?>


<section id="all-books" class="container bg-all">
    <h1>Les derniers livres que nous avons dévorés</h1>

    <div class="flex-md justify-between-md">
    <?php foreach($datas as $book){ ?>
        
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





<?php include ('layouts/footer.php')?>