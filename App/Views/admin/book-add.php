<?php $currentPageTitle = "Ajouter un livre";
 include_once('./App/Views/admin/layouts/header.php');?>

<section id="book-form" class="container-lg">

    <div class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1 class="text-center">Ajouter un livre</h1>

    <form action="indexAdmin.php?action=livresaddPost" method="post" enctype="multipart/form-data">
        <div class="flex justify-between">
            <div>
                <!-- Title -->
                <div>
                    <p><label for="newTitle">Titre du livre <span class="required">*</span></label></p>
                    <p><input type="text" name="newTitle" id="newTitle" required></p>
                </div>
                <!-- Author -->
                <div>
                    <p><label for="newAuthor">Auteur</label></p>
                    <p><input type="text" name="newAuthor" id="newAuthor"></p>
                </div>
                <!-- Year -->
                <div>
                    <p><label for="newYear_publication">Année de publication</label></p>
                    <p><input type="text" name="newYear_publication" id="newYear_publication" size="4"></p>
                </div>
                <!-- Genre -->
                <div>
                    <p><label for="newGenre">Genre <span class="required">*</span></label></p>
                    <select id="newGenre" name="newGenre" required>
                        <option value="" class="placeholder" selected disabled hidden></option>
                        <?php foreach($datas as $data){?>
                            <option value="<?= $data['category']; ?>"><?= $data['category']; ?></option>
                        <?php }?>
                    </select>
                </div>
                <!-- Notation -->
                <div>
                    <p><label for="newNotation">Note du livre</label></p>
                    <p><input name="newNotation" id="newNotation" type="range" min="1" max="5" step="1" value="1">
                    <output id="range-result">1</output> / 5</p>
                </div> 
                <!-- Cover + preview -->
                <div>
                    <p id="displayImg">Couverture du livre</p>
                    <label for="inputImg" class="custom-file-upload ajout">
                        <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une image" title="Ajouter une image">
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
                    <textarea class="catchphrase" name="newCatchphrase" id="newCatchphrase" maxlength="300" required></textarea>
                    <p id="count"><span id="counter">0</span> / 300</p>
                </div>
                <!-- Content -->
                <div>
                    <p><label for="newContent">Contenu de l'article <span class="required">*</span></label></p>
                    <textarea class="content" name="newContent" id="newContent" required></textarea>
                </div>
            </div>
        </div>
                    
        <p class="text-center"><input type="submit" value="Publier"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>