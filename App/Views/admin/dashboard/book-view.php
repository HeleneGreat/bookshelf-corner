<?php include_once('./App/Views/admin/layouts/header.php');?>

<section id="one-book">

    <div>
        <p><img src="./App/Public/Books/images/<?= $datas['picture']; ?>" alt="<?= $datas['title']; ?>"></p>
        <p>Mon avis : <?= $datas['notation']; ?> / 5</p>
    </div>


<p class="retour container"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i> Retour</a></p>

    <h1 class="container"><?= $datas['title']; ?></h1>
    
    <div class="container flex-lg justify-around">
        <div>
            <p><?= $datas['author']; ?></p>
            <p><?= $datas['year_publication']; ?></p>
            <p><?= $datas['genre']; ?></p>
        </div>
        <div>
            <p><a href="<?= $datas['linkEdition']; ?>"><?= $datas['edition']; ?></a></p>
            <p><?= $datas['location']; ?></p>
        </div>
    </div>
    <div class="container">
        <p class="catchphrase"><?= $datas['catchphrase']; ?></p>
        <p class="content"><?= $datas['content']; ?></p>
    </div>

</section>

<!-- Link to modify this book -->
<a href="indexAdmin.php?action=livresmodify&id=<?= $datas['ID']; ?>">
    <div class="modify-btn mobile-btn">
        <img src="./App/Public/Admin/images/pen-white.png" alt="Modifier ce livre">
    </div>
</a>

<?php include_once('./App/Views/admin/layouts/footer.php');?>