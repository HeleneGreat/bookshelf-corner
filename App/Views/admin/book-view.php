<?php $currentPageTitle = $datas['title'] ;
include_once('./App/Views/admin/layouts/header.php');?>

<section id="one-book" class="container-lg">
    <div class="retour"><a href="indexAdmin.php?action=livres" title="Retour"><i class="fas fa-arrow-circle-left"></i></a></div>

    <div id="btn-delete" class="delete"><a href="indexAdmin.php?action=livresdelete&id=<?= $datas['id'];?>" title="Supprimer ce livre" class="fa-stack"><i class="fa-solid fa-circle fa-stack-2x"></i><i class="fa-solid fa-trash-can fa-stack-1x"></i></a></div>


    <!-- DELETE CONFIRMATION MODAL -->
    <div id="myModal" class="modal display-none">
        <div class="modal-content text-center">
            <span class="close bold">X</span>
            <p><i class="fa-solid fa-trash-can"></i></p>
            <p class="bold">Demande de confirmation</p>
            <p>Êtes-vous sûr de vouloir supprimer ce livre :</p>
            <p><span class="italic"><?= $datas['title']; ?></span> ?</p>
            <p><b>Attention</b> : tous les commentaires associés à ce livre seront également supprimés.</p>
            <div class="flex justify-center">
                <a id="cancel" class="btn center" title="Retour">Annuler</a>
                <a href="indexAdmin.php?action=livresdelete&id=<?= $datas['id'];?>" title="Supprimer ce livre" class="btn center">Supprimer</a>
            </div>
        </div>
    </div>

    <!-- Book cover + notation -->
    <div>
        <p><img id="book-cover" src="./App/Public/Books/images/<?= $datas['picture']; ?>" alt="<?= $datas['title']; ?>"></p>
        <p>Mon avis : <?= $datas['notation']; ?> / 5</p>
    </div>

    <!-- Title -->
    <h1><?= $datas['title']; ?></h1>
    
    <!-- Book information -->
    <div class="flex-md justify-around">
        <div>
            <p>Auteur : <span class="bold"><?= $datas['author']; ?></span></p>
            <p>Année de publication : <span class="bold"><?= $datas['year_publication']; ?></span></p>
        </div>
        <div>
            <p>Article publié le : <?= $datas['date']; ?></p>
            <p>Genre : <span class="bold"><?= $datas['category']; ?></span></p>
        </div>
    </div>

    <!-- Book review -->
    <div>
        <p class="catchphrase"><?= $datas['catchphrase']; ?></p>
        <p class="content"><?= $datas['content']; ?></p>
    </div>
</section>

<!-- Link to modify this book -->
<div class="flex justify-end">
    <a href="indexAdmin.php?action=livresmodify&id=<?= $datas['id']; ?>" title="Modifier ce livre">
        <div class="modify-btn thumb-btn">
            <img src="./App/Public/Admin/images/pen-white.png" alt="Modifier ce livre">
        </div>
    </a>
</div>



<?php include_once('./App/Views/admin/layouts/footer.php');?>