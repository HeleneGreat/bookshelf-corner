<?php $currentPageTitle = "Tous les commentaires";
 include_once('./App/Views/admin/layouts/header.php');
 include_once('./App/Views/admin/layouts/header-comments.php');?>


<section id="all-comments" class="container-lg">

    <h1>Liste des commentaires</h1>   
    <?php foreach($datas['comments'] as $data){ 
        if(isset($data['id'])){
        ?>
        <article class="flex">
            <div class="comment-info flex justify-between align-items-center">
                <p class="time"><?= $data['created_at']; ?></p>
                <?= isset($data['userPseudo']) ? "<p>".$data['userPseudo'] : "<p class='admin'>".$data['adminPseudo']; ?></p>
                <p class="object"><?= $data['title']; ?></p>
            </div>
            <div class="flex comment-link">
                <a title="Lire ce commentaire" href="indexAdmin.php?action=commentsView&id=<?=$data['id']; ?>" class="stretched-link"><i class="fa-solid fa-eye"></i></a>
                <button title="Supprimer ce commentaire" id="btn-delete-<?= $data['id']; ?>" class="btn-delete-this"><a><i class="fa-regular fa-trash-can lg"></i></a></button>
            </div>
        </article>
        
        <!-- DELETE CONFIRMATION MODAL FOR COMMENTS -->
        <div id="myModal<?= $data['id']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span id="closing-<?= $data['id']; ?>" class="closing close bold">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce commentaire de :</p>
                <p><span class="italic">
                    <?= isset($data['userPseudo']) ? $data['userPseudo'] : $data['adminPseudo'];?>
                </span> ?</p>
                <div class="flex justify-center">
                    <a id="cancel-<?= $data['id']; ?>" class="cancel btn center" title="Retour">Annuler</a>
                    <a href="indexAdmin.php?action=commentsDelete&id=<?= $data['id'];?>" title="Supprimer ce commentaire" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>
    <?php } ; }?> 
    <nav>
        <ul id="pagination" class="flex justify-center">
            <!-- PREVIOUS PAGE -->
            <li class="<?= ($datas['currentPage'] == 1) ? "display-none" : "" ?>">
                <a class="controller previous" title="Page précédente" href="indexAdmin.php?action=comments&page=<?= $datas['currentPage'] - 1 ?>"><</a>
            </li>
            <!-- ALL PAGES NUMBER -->
            <?php for($page = 1; $page <= $datas['pages']; $page++): ?>
                <li class="<?= ($datas['currentPage'] == $page) ? "bold active" : "not-active" ?>">
                    <a class="nb-page" href="indexAdmin.php?action=comments&page=<?= $page ?>"><?= $page ?></a>
                </li>
            <?php endfor ?>
                <!-- NEXT PAGE -->
                <li class="<?= ($datas['currentPage'] == $datas['pages']) ? "display-none" : "" ?>">
                <a class="controller next" title="Page suivante" href="indexAdmin.php?action=comments&page=<?= $datas['currentPage'] + 1 ?>">></a>
            </li>
        </ul>
    </nav>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>