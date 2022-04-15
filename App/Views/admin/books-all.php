<?php 
    include_once('./App/Views/admin/layouts/header.php');
    include_once('./App/Views/admin/layouts/header-books.php');

?>


<!-- Books Tab -->
<section id="all-books">
    <?php foreach($datas as $book){ 
        if(isset($book['title'])){
        ?> 
        <article class="flex">
            <img src="./App/Public/Books/images/<?= $book['picture']; ?>" alt="Couverture <?= $book['title']; ?>">
            <div class='info'>
                <p class="list-title"><?= $book['title']; ?></p>
                <p class="list-location"><?= $book['location']; ?></p>
                <p class="list-date"><?= $book['date']; ?></p>
            </div>
            <div class="flex book-link">
                <a title="Voir ce livre" href="indexAdmin.php?action=livresview&id=<?= $book['id']; ?>" class="stretched-link"><i class="fa-solid fa-eye"></i></a>
                <a title="Modifier ce livre" href="indexAdmin.php?action=livresmodify&id=<?= $book['id']; ?>"><i class="fa-solid fa-pencil lg"></i></a>
                <button title="Supprimer ce livre" id="btn-delete-<?= $book['id']; ?>" onclick="modalDelete(<?= $book['id']; ?>)"><a><i class="fa-regular fa-trash-can lg"></i></a></button>
            </div>
        </article>


          <!-- DELETE CONFIRMATION MODAL FOR BOOKS -->
        <div id="myModal<?= $book['id']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span class="close bold" onclick="modalClose(<?= $book['id']; ?>)">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce livre :</p>
                <p><span class="italic"><?= $book['title']; ?></span> ?</p>
                <div class="flex justify-center">
                    <a class="btn center" title="Retour" onclick="modalClose(<?= $book['id']; ?>)">Annuler</a>
                    <a href="indexAdmin.php?action=livresdelete&id=<?= $book['id'];?>" title="Supprimer ce livre" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>

    <?php }} ?> 
</section>

<!-- Link to add a new book -->
<div class="flex justify-end">
    <a href="indexAdmin.php?action=livresadd" title="Ajouter un nouveau livre">
        <div class="add-btn thumb-btn">
            <img src="./App/Public/Admin/images/book-white.png" alt="Ajouter un nouveau livre">
        </div>
    </a>
</div>




<?php include_once('./App/Views/admin/layouts/footer.php');?>