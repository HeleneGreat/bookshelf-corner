<?php 
    include_once('./App/Views/admin/layouts/header.php');
    include_once('./App/Views/admin/layouts/header-books.php');
?>

<!-- Category Tab -->
<section id="book-cat">
    <?php foreach($datas as $data){ 
        if(isset($data['id'])){
        ?> 
        <article class="one-cat">
            <!-- GENRE -->
            <div class="flex">
                <div class="flex">
                    <div class="cat-img text-center">
                        <img src="./App/Public/Books/images/<?= $data['icon']; ?>" alt="Genre : <?= $data['category']; ?>">
                    </div>
                    <p class="list-title"><?= $data['category']; ?></p>
                </div>
                <div class="flex cat-link">
                    <a id="modify-<?= $data['id']; ?>" title="Modifier la catégorie" class="modify-this"><i class="fa-solid fa-pencil"></i></a>
                    <button title="Supprimer la catégorie" id="btn-delete-<?= $data['id']; ?>" class="btn-delete-this"><a><i class="fa-regular fa-trash-can"></i></a></button>
                </div>
            </div>
            <!-- FORM MODIFY GENRE -->
            <form id="modify<?= $data['id']; ?>" action="indexAdmin.php?action=genreModifyPost&id=<?= $data['id']; ?>" method="post" enctype="multipart/form-data" class="flex display-none">
                <label for="picture" class="custom-file-upload-cat ajout">
                    <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une icône" title="Ajouter une icône">
                    <input type="file" name="picture" id="inputImg<?= $data['id']; ?>" accept="image/*">
                </label>
                <p><input type="text" name="newType" id="newType" placeholder="Nouveau titre de genre"></p>
                <div class="cat-submit">
                    <p><input type="submit" value="Modifier"></p>
                </div>
            </form>
        </article>

          <!-- DELETE CONFIRMATION MODAL FOR GENRES -->
          <div id="myModal<?= $data['id']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span id="closing-<?= $data['id']; ?>" class="closing close bold">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce genre littéraire :</p>
                <p><span class="italic"><?= $data['category']; ?></span> ?</p>
                <div class="flex justify-center">
                    <a id="cancel-<?= $data['id']; ?>" class="cancel btn center" title="Retour">Annuler</a>
                    <a href="indexAdmin.php?action=genreDelete&id=<?= $data['id'];?>" title="Supprimer ce genre" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>
    <?php }} ?> 

    <!-- FORM ADD A NEW GENRE -->
    <article id="book-form" class="text-center">
        <h2>Ajouter une nouvelle catégorie</h2>
        <form action="indexAdmin.php?action=genreAddPost" method="post" enctype="multipart/form-data">
            <div>
                <p><label for="newType">Genre littéraire : <span class="required">*</span></label></p>
                <p><input type="text" name="newType" id="newType" required></p>
            </div>
            <div>
                <p id="displayImg">Icône :</p>
                <label for="picture" class="custom-file-upload-cat ajout center">
                    <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une icône" title="Ajouter une icône">
                    <input type="file" name="picture" id="inputImg" accept="image/*">
                </label>
            </div>
            <p><input type="submit" value="Ajouter"></p>
        </form>
    </article>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>