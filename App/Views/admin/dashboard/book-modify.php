<?php include_once('./App/Views/admin/layouts/header.php');?>

<section id="book-form">

<div class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1 class="text-center">Modifier le livre</h1>
 
    <form action="indexAdmin.php?action=livresmodifyPost&id=<?= $datas['ID'];?>" method="post">
        <div class="flex justify-between">
            <div>
            <!-- Book information -->
                <div>
                    <p><label for="newTitle">Titre du livre</label></p>
                    <p><input type="text" name="newTitle" id="newTitle" value="<?= $datas['title']; ?>"></p>
                </div>
                <div>
                    <p><label for="newAuthor">Auteur</label></p>
                    <p><input type="text" name="newAuthor" id="newAuthor" value="<?= $datas['author']; ?>"></p>
                </div>
                <div>
                    <p><label for="newYear_publication">Année de publication</label></p>
                    <p><input type="text" name="newYear_publication" id="newYear_publication" size="4" value="<?= $datas['year_publication']; ?>"></p>
                </div>
                <div>
                    <p><label for="newGenre">Genre</label></p>
                    <select id="newGenre" name="newGenre">
                        <!-- <option value="none">--</option> -->
                        <option value="Aventure" <?php if($datas['genre'] == "Aventure"){echo "selected";} ?>>Aventure</option>
                        <option value="Classique" <?php if($datas['genre'] == "Classique"){echo "selected";} ?>>Classique</option>
                        <option value="Fantasy" <?php if($datas['genre'] == "Fantasy"){echo "selected";} ?>>Fantasy</option>
                        <option value="Historique" <?php if($datas['genre'] == "Historique"){echo "selected";} ?>>Historique</option>
                        <option value="Policier" <?php if($datas['genre'] == "Policier"){echo "selected";} ?>>Policier</option>
                        <option value="Romance" <?php if($datas['genre'] == "Romance"){echo "selected";} ?>>Romance</option>
                    </select>
                </div>
                <div>
                    <p><label for="newEdition">Nom de l'éditeur</label></p>
                    <p><input type="text" name="newEdition" id="newEdition" value="<?= $datas['edition']; ?>"></p>
                </div>
                <div>
                    <p><label for="newLinkEdition">Lien vers le site de l'éditeur</label></p>
                    <p><input type="url" name="newLinkEdition" id="newLinkEdition" value="<?= $datas['linkEdition']; ?>"></p>
                </div>
                <div>
                    <p><label for="newLocation">Ville où se déroule l'intrigue</label></p>
                    <p><input type="text" name="newLocation" id="newLocation" value="<?= $datas['location']; ?>"></p>
                </div>
                <div>
                    <p><label for="newPicture">Image de la couverture du livre</label></p>
                    <p><input type="file" name="newPicture" id="newPicture" value="<?= $datas['picture']; ?>" accept=".jpg, .jpeg, .png, .gif, .webp"></p>
                </div>
                <div>
                    <p><label for="newNotation">Note du livre</label></p>
                    <p><input name="newNotation" id="newNotation" type="range" min="0" max="5" step="1" value="<?= $datas['notation']; ?>" oninput="this.nextElementSibling.value = this.value">
                    <output><?= $datas['notation']; ?></output> / 5</p>
                </div>
            </div>

            <!-- Text zones -->
            <div class="zones-text">                
                <div>
                    <p><label for="newCatchphrase">Accroche de l'article</label></p>
                    <textarea class="catchphrase" name="newCatchphrase" id="newCatchphrase"> <?= $datas['catchphrase']; ?></textarea>
                </div>
                <div>
                    <p><label for="newContent">Contenu de l'article</label></p>
                    <textarea class="content" name="newContent" id="newContent"><?= $datas['content']; ?></textarea>
                </div>
            </div>
        </div>
                       
        <p class="text-center"><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>