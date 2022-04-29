<?php include_once('./App/Views/admin/layouts/header.php');?>

<section id="all-messages" class="container-lg">

    <h1>Liste des messages</h1>   
    <?php 
    foreach($datas as $msg){ 
        if(isset($msg['object'])){
        ?>
        <article class="flex">
            <div class="message-info flex justify-between align-items-center">
                <p class="time"><?= $msg['send_at']; ?></p>
                <p><?= $msg['firstname']; ?></p>
                <p><?= $msg['familyname']; ?></p>
                <p class="object"><?= $msg['object']; ?></p>
            </div>
            <div class="flex message-link">
                <a title="Lire ce message" href="indexAdmin.php?action=messagesView&id=<?=$msg['id']; ?>" class="stretched-link"><i class="fa-solid fa-eye"></i></a>
                <a href="indexAdmin.php?action=messagesDelete&id=<?= $msg['id'];?>" title="Supprimer ce message" id="btn-delete-<?= $msg['id']; ?>" class="btn-delete-this"><i class="fa-regular fa-trash-can lg"></i></a>
            </div>
        </article>
        
          <!-- DELETE CONFIRMATION MODAL FOR MESSAGES -->
          <div id="myModal<?= $msg['id']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span id="closing-<?= $msg['id']; ?>" class="closing close bold">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce messages de :</p>
                <p><span class="italic"><?= $msg['firstname']; $msg['familyname']; ?></span> ?</p>
                <div class="flex justify-center">
                    <a id="cancel-<?= $msg['id']; ?>" class="cancel btn center" title="Retour">Annuler</a>
                    <a href="indexAdmin.php?action=messagesDelete&id=<?= $msg['id'];?>" title="Supprimer ce message" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>

        <?php } ; }?> 
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>