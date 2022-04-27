<?php include_once('./App/Views/admin/layouts/header.php');?>


<section id="all-comments">

    <h1>Liste des commentaires</h1>   
    <?php 
    foreach($datas as $data){ 
        if(isset($data['pseudo'])){
        ?>
        <article class="flex">
            <div class="comment-info flex justify-between align-items-center">
                <p class="time"><?= $data['created_at']; ?></p>
                <p><?= $data['pseudo']; ?></p>
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
                <p><span class="italic"><?= $data['pseudo']; ?></span> ?</p>
                <div class="flex justify-center">
                    <a id="cancel-<?= $data['id']; ?>" class="cancel btn center" title="Retour">Annuler</a>
                    <a href="indexAdmin.php?action=commentsDelete&id=<?= $data['id'];?>" title="Supprimer ce commentaire" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>
        <?php } ; }?> 
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>