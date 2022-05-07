<?php $currentPageTitle = "Commentaire de " . $datas['pseudo'];
 include_once('./App/Views/admin/layouts/header.php');?>

<section id="one-comment" class="container-lg">
    <div class="retour"><a href="indexAdmin.php?action=comments" title="Retour"><i class="fas fa-arrow-circle-left"></i></a></div>

    <div id="btn-delete" class="delete"><a href="indexAdmin.php?action=commentsDelete&id=<?= $datas['id'];?>" title="Supprimer ce comment" class="fa-stack"><i class="fa-solid fa-circle fa-stack-2x"></i><i class="fa-solid fa-trash-can fa-stack-1x"></i></a></div>


    <!-- DELETE CONFIRMATION MODAL -->
    <div id="myModal" class="modal display-none">
        <div class="modal-content text-center">
            <span class="close bold">X</span>
            <p><i class="fa-solid fa-trash-can"></i></p>
            <p class="bold">Demande de confirmation</p>
            <p>Êtes-vous sûr de vouloir supprimer ce commentaire de</p>
            <p><span class="italic"><?= $datas['pseudo']; ?></span> ?</p>
            <div class="flex justify-center">
                <a id="cancel" class="btn center" title="Retour">Annuler</a>
                <a href="indexAdmin.php?action=commentsDelete&id=<?= $datas['id'];?>" title="Supprimer ce commentaire" class="btn center">Supprimer</a>
            </div>
        </div>
    </div>
    
    <article>
        <h1 class="text-center">Commentaire de <?= $datas['pseudo']; ?></h1>
        <p>Livre commenté : <span class="bold dashboard"><?= $datas['bookTitle']; ?></span></p>
        <div class="msg-info flex-md justify-around">
            <p>Lecteur : <span class="bold"><?= $datas['pseudo']; ?></span></p>
            <p>Date du commentaire : <span class="bold"><?= $datas['created_at']; ?></span></p>
        </div>
        <div class="msg-content">
            <p>Objet du commentaire : <span class="bold"><?= $datas['commentTitle']; ?></span></p>
            <p><?= $datas['commentContent']; ?></p>
        </div>
    </article>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>