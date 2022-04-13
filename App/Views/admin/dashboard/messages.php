<?php include_once('./App/Views/admin/layouts/header.php');?>



<section id="all-messages" class="">

    <h1>Liste des messages</h1>   
    <?php 
    foreach($datas as $msg){ 
        ?>
        <article class="flex">
            <div class="message-info flex justify-between align-items-center">
                <p><?= $msg['send_at']; ?></p>
                <p><?= $msg['firstname']; ?></p>
                <p><?= $msg['familyname']; ?></p>
                <p class="object"><?= $msg['object']; ?></p>
            </div>
            <div class="flex message-link">
                <a href="indexAdmin.php?action=messageview&id=<?=$msg['id']; ?>" class="stretched-link"><i class="fa-solid fa-eye"></i></a>
                <button id="btn-delete-<?= $msg['id']; ?>" onclick="modalDelete(<?= $msg['id']; ?>)"><a title="Supprimer ce message"><i class="fa-regular fa-trash-can lg"></i></a></button>
            </div>
        </article>

        
          <!-- DELETE CONFIRMATION MODAL FOR MESSAGES -->
          <div id="myModal<?= $msg['id']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span class="close bold" onclick="modalClose(<?= $msg['id']; ?>)">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce messages de :</p>
                <p><span class="italic"><?= $msg['firstname']; $msg['familyname']; ?></span> ?</p>
                <div class="flex justify-center">
                    <a class="btn center" title="Retour" onclick="modalClose(<?= $msg['id']; ?>)">Annuler</a>
                    <a href="indexAdmin.php?action=messageDelete&id=<?= $msg['id'];?>" title="Supprimer ce message" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>

        <?php } ?> 
</section>






<?php include_once('./App/Views/admin/layouts/footer.php');?>