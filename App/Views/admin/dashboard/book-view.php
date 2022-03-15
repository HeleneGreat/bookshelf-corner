<?php include_once('./App/Views/admin/layouts/header.php');?>

<section>
<p class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i> Retour</a></p>

<p>détail de ce livre</p>
    <h1><?= $book['title']; ?></h1>
    
    <div class="flex justify-around">
        <div>
        <p><?= $book['author']; ?></p>
        <p><?= $book['year_publication']; ?></p>
        <p><?= $book['genre']; ?></p>
        </div>
        <div>
        <p><?= $book['edition']; ?></p>
        <p><?= $book['linkEdition']; ?></p>
        <p><?= $book['location']; ?></p>
        </div>
    </div>
    <p><?= $book['catchphrase']; ?></p>
    <p><?= $book['content']; ?></p>
    <div class="flex justify-around">
        <p><img src="./App/Public/Front/images/<?= $book['picture']; ?>" alt="<?= $book['title']; ?>"></p>
        <p><?= $book['notation']; ?> / 5</p>
    </div>

</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>