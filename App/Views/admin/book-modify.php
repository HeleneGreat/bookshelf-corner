<?php $currentPageTitle = "Modifier le livre";
include_once('./App/Views/admin/layouts/header.php');?> 
<section id="book-form" class="container-lg">

<div class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1 class="text-center">Modifier le livre</h1>
 
    <form action="indexAdmin.php?action=livresmodifyPost&id=<?= $datas['book']['id'];?>" method="post" enctype="multipart/form-data">
        <div class="flex justify-between">
            <div>
            <!-- Book information -->
                <div>
                    <p><label for="newTitle">Titre du livre</label></p>
                    <p><input type="text" name="newTitle" id="newTitle" value="<?= $datas['book']['title']; ?>"></p>
                </div>
                <div>
                    <p><label for="newAuthor">Auteur</label></p>
                    <p><input type="text" name="newAuthor" id="newAuthor" value="<?= $datas['book']['author']; ?>"></p>
                </div>
                <div>
                    <p><label for="newYear_publication">Année de publication</label></p>
                    <p><input type="text" name="newYear_publication" id="newYear_publication" size="4" value="<?= $datas['book']['year_publication']; ?>"></p>
                </div>
                <div>
                    <p><label for="newGenre">Genre</label></p>
                    <select id="newGenre" name="newGenre">
                        <!-- <option value="<?= $datas['book']['category']; ?>" selected><?= $datas['book']['category']; ?></option> -->
                        <?php foreach ($datas['genres'] as $data) { ?>
                            <option value="<?= $data['category']; ?>"
                                <?php if($datas['book']['category'] == $data['category'] ) { echo "selected" ;} ; ?>
                            ><?= $data['category']; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <div>
                    <p><label for="newEdition">Nom de l'éditeur</label></p>
                    <p><input type="text" name="newEdition" id="newEdition" value="<?= $datas['book']['edition']; ?>"></p>
                </div>
                <div>
                    <p><label for="newLinkEdition">Lien vers le site de l'éditeur</label></p>
                    <p><input type="url" name="newLinkEdition" id="newLinkEdition" value="<?= $datas['book']['linkEdition']; ?>"></p>
                </div>
                <div>
                    <p><label for="newLocation">Ville où se déroule l'intrigue</label></p>
                    <p><input type="text" name="newLocation" id="newLocation" value="<?= $datas['book']['location']; ?>"></p>
                </div>
                <div>
                    <p><label for="newNotation">Note du livre</label></p>
                    <p><input name="newNotation" id="newNotation" type="range" min="0" max="5" step="1" value="<?= $datas['book']['notation']; ?>">
                    <output id="range-result"><?= $datas['book']['notation']; ?></output> / 5</p>
                </div>
                <!-- input file -->
                <div>
                <p>Couverture du livre :</p>
                <img class="old-picture" src="./App/Public/Books/images/<?= $datas['book']['picture'] ; ?>" alt="Image de profil de <?= $datas['book']['title']; ?>">
            </div>
                <div>
                    <p id="displayImg">Nouvelle image de couverture :</p>
                    <label for="picture" class="custom-file-upload ajout">
                        <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une image">
                        <input type="file" name="picture" id="inputImg" accept="image/*">
                    </label>
                    <p class="flex justify-center"><img class="display-none" src="" id="preview" alt=""></p>
                </div>
            </div>

            <!-- Text zones -->
            <div class="zones-text">                
                <div>
                    <p><label for="newCatchphrase">Accroche de l'article</label></p>
                    <textarea class="catchphrase" name="newCatchphrase" id="newCatchphrase" maxlength="300"><?= $datas['book']['catchphrase']; ?></textarea>
                    <p id="count"><span id="counter">0</span> / 300</p>
                </div>
                <div>
                    <p><label for="newContent">Contenu de l'article</label></p>
                    <textarea class="content" name="newContent" id="newContent"><?= $datas['book']['content']; ?></textarea>
                </div>
            </div>
        </div>
                       
        <p class="text-center"><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>