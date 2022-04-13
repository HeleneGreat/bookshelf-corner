<?php include_once('./App/Views/admin/layouts/header.php');?>

<section id="one-message">
    <div class="retour"><a href="indexAdmin.php?action=messages" title="Retour"><i class="fas fa-arrow-circle-left"></i></a></div>

    <div id="btn-delete" class="delete"><a title="Supprimer ce message" class="fa-stack"><i class="fa-solid fa-circle fa-stack-2x"></i><i class="fa-solid fa-trash-can fa-stack-1x"></i></a></div>


    <!-- DELETE CONFIRMATION MODAL -->
    <div id="myModal" class="modal display-none">
        <div class="modal-content text-center">
            <span class="close bold">X</span>
            <p><i class="fa-solid fa-trash-can"></i></p>
            <p class="bold">Demande de confirmation</p>
            <p>Êtes-vous sûr de vouloir supprimer ce message de</p>
            <p><span class="italic"><?= $datas['firstname']; $datas['familyname']; ?></span> ?</p>
            <div class="flex justify-center">
                <a id="cancel" class="btn center" title="Retour">Annuler</a>
                <a href="indexAdmin.php?action=messageDelete&id=<?= $datas['id'];?>" title="Supprimer ce message" class="btn center">Supprimer</a>
            </div>
        </div>
    </div>

    
    <article>
        <h1 class="text-center">Message de <?= $datas['firstname']; ?></h1>
        <div class="msg-info flex justify-around">
            <div>
                <p>Prénom : <span class="bold"><?= $datas['firstname']; ?></span></p>
                <p>Nom : <span class="bold"><?= $datas['familyname']; ?></span></p>
                <p>Genre : <?= $datas['gender']; ?></p>
            </div>
            <div>
                <p>Date du message : <span class="bold"><?= $datas['send_at']; ?></span></p>
                <p>Mail : <span class="bold"><?= $datas['email']; ?></span></p>
            </div>
        </div>
        <div class="msg-content">
            <p>Objet du message : <span class="bold"><?= $datas['object']; ?></span></p>
            <p>Message :</p>
            <p><?= $datas['message']; ?></p>
        </div>

        <a href="mailto:<?= $datas['email']; ?>" class="btn center">Répondre à <?= $datas['firstname']; ?></a>

    </article>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>