<?php $currentPageTitle = "Modifier le livre";
include_once('./App/Views/admin/layouts/header.php');?> 
<section id="book-form" class="container-lg">

<div class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1 class="text-center">Modifier le livre</h1>
 
    <form action="indexAdmin.php?action=livresmodifyPost&id=<?= $datas['book']['id'];?>" method="post" enctype="multipart/form-data">
        <div class="flex justify-between">
            <div>
                <!-- Title -->
                <div>
                    <p><label for="newTitle">Titre du livre <span class="required">*</span></label></p>
                    <p><input type="text" name="newTitle" id="newTitle" value="<?= $datas['book']['title']; ?>" required></p>
                </div>
                <!-- Author -->
                <div>
                    <p><label for="newAuthor">Auteur</label></p>
                    <p><input type="text" name="newAuthor" id="newAuthor" value="<?= $datas['book']['author']; ?>"></p>
                </div>
                <!-- Year -->
                <div>
                    <p><label for="newYear_publication">Année de publication</label></p>
                    <p><input type="text" name="newYear_publication" id="newYear_publication" size="4" value="<?= $datas['book']['year_publication']; ?>"></p>
                </div>
                <!-- Genre -->
                <div>
                    <p><label for="newGenre">Genre <span class="required">*</span></label></p>
                    <select id="newGenre" name="newGenre">
                        <?php foreach ($datas['genres'] as $data) { ?>
                            <option value="<?= $data['category']; ?>"
                                <?php if($datas['book']['category'] == $data['category'] ) { echo "selected" ;} ; ?>
                            ><?= $data['category']; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <!-- Notation -->
                <div>
                    <p><label for="newNotation">Note du livre</label></p>
                    <p><input name="newNotation" id="newNotation" type="range" min="1" max="5" step="1" value="<?= $datas['book']['notation']; ?>">
                    <output id="range-result"><?= $datas['book']['notation']; ?></output> / 5</p>
                </div>
                <!-- Cover -->
                <div>
                    <p>Couverture du livre :</p>
                    <img class="old-picture" src="./App/Public/Books/images/<?= $datas['book']['picture'] ; ?>" alt="Image de profil de <?= $datas['book']['title']; ?>">
                </div>
                <!-- Preview -->
                <div>
                    <p id="displayImg">Nouvelle image de couverture :</p>
                    <label for="inputImg" class="custom-file-upload ajout">
                        <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une image">
                        <input type="file" name="picture" id="inputImg" accept="image/*">
                    </label>
                    <p class="flex justify-center"><img class="display-none" src="" id="preview" alt=""></p>
                </div>
            </div>

            <!-- Text zones -->
            <div class="zones-text">
                <!-- Catchphrase -->
                <div>
                    <p><label for="newCatchphrase">Accroche de l'article <span class="required">*</span></label></p>
                    <textarea class="catchphrase" name="newCatchphrase" id="newCatchphrase" maxlength="300" required><?= $datas['book']['catchphrase']; ?></textarea>
                    <p id="count"><span id="counter">0</span> / 300</p>
                </div>
                <!-- Content -->
                <div>
                    <p><label for="newContent">Contenu de l'article <span class="required">*</span></label></p>
                    <textarea class="content" name="newContent" id="newContent" required><?= $datas['book']['content']; ?></textarea>
                </div>
            </div>
        </div>
                       
        <p class="text-center"><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>