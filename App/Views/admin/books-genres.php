<?php $currentPageTitle = "Toutes les catégories";
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
                        <img src="./App/Public/Books/images/<?= $data['picture']; ?>" alt="Genre : <?= $data['category']; ?>">
                    </div>
                    <p class="list-title"><?= $data['category']; ?></p>
                </div>
                <div class="flex cat-link">
                    <?php if($data['id'] != 21){ ?>
                    <a id="modify-<?= $data['id']; ?>" title="Modifier la catégorie" class="modify-this"><i class="fa-solid fa-pencil"></i></a>
                    <a href="indexAdmin.php?action=genreDelete&id=<?= $data['id'];?>" title="Supprimer la catégorie" id="btn-delete-<?= $data['id']; ?>" class="btn-delete-this"><i class="fa-regular fa-trash-can"></i></a>
                    <?php } ;?>
                </div>
            </div>
            <?php if($data['id'] != 21){ ?>
            <!-- FORM MODIFY GENRE -->
            <form id="modify<?= $data['id']; ?>" action="indexAdmin.php?action=genreModifyPost&id=<?= $data['id']; ?>" method="post" enctype="multipart/form-data" class="flex display-none">
                <label for="picture" class="custom-file-upload-cat ajout">
                    <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une icône" title="Ajouter une icône">
                    <input type="file" name="picture" id="inputImg<?= $data['id']; ?>" accept="image/*">
                </label>
                <p><input type="text" name="newType" id="newType" value="<?= $data['category']; ?>"></p>
                <div class="cat-submit">
                    <p><input type="submit" value="Modifier"></p>
                </div>
            </form>
            <?php } ?>
        </article>

        <?php if($data['id'] != 21){ ?>
          <!-- DELETE CONFIRMATION MODAL FOR GENRES -->
        <div id="myModal<?= $data['id']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span id="closing-<?= $data['id']; ?>" class="closing close bold">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce genre littéraire : <span class="italic bold"><?= $data['category']; ?></span> ?</p>
                <p>Les livres associés à ce genre basculeront dans la catégorie "Autres"</p>
                <div class="flex justify-center">
                    <a id="cancel-<?= $data['id']; ?>" class="cancel btn center" title="Retour">Annuler</a>
                    <a href="indexAdmin.php?action=genreDelete&id=<?= $data['id'];?>" title="Supprimer ce genre" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>
        <?php } ?>
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