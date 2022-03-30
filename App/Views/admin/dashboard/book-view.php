<?php include_once('./App/Views/admin/layouts/header.php');?>

<div class="retour container"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i></a></div>

<div class="delete container"><a href="indexAdmin.php?action=livresdelete&id=<?= $datas['ID'];?>" class="fa-stack"><i class="fa-solid fa-circle fa-stack-2x"></i><i class="fa-solid fa-trash-can fa-stack-1x"></i></a></div>

<section id="one-book">
    <div>
        <p><img src="./App/Public/Books/images/<?= $datas['picture']; ?>" alt="<?= $datas['title']; ?>"></p>
        <p>Mon avis : <?= $datas['notation']; ?> / 5</p>
    </div>

    <h1><?= $datas['title']; ?></h1>
    
    <div class="flex-md justify-around">
        <div>
            <p>Auteur : <span class="bold"><?= $datas['author']; ?></span></p>
            <p>Année de publication : <span class="bold"><?= $datas['year_publication']; ?></span></p>
            <p>Genre : <span class="bold"><?= $datas['genre']; ?></span></p>
        </div>
        <div>
            <p>Edition : <a href="<?= $datas['linkEdition']; ?>" target="blank"><span class="bold"><?= $datas['edition']; ?></span></a></p>
            <p>Ville de l'intrigue : <span class="bold"><?= $datas['location']; ?></span></p>
        </div>
    </div>
    <div>
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