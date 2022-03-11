<?php include ('layouts/header.php')?>


<section id="all-books" class="container">
    <h1 class="text-center">Derniers articles</h1>

    <div class="flex justify-between">
    <?php foreach($books as $book){ ?>
        <a href="index.php?action=un-livre&<?= $book->id; ?>">
            <article id="book-card">
                <h2 class="text-center"><?= $book->title; ?></h2>
                <h3 class="text-center"><?= $book->author; ?></h3>
                <img src="<?= $book->picture; ?>" alt="La couverture du roman <?= $book->title; ?>">
            </article>
        </a>

    <?php }; ?>
    </div>
</section>





<?php include ('layouts/footer.php')?>