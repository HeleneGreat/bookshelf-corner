<?php include_once('./App/Views/admin/layouts/header.php');?>

<section>

    <a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i> Retour</a>

    <h1>Modifier le livre</h1>
 
    <form action="indexAdmin.php?action=livresmodifyPost&id=<?= $id;?>" method="post">
        <div>
            <p><label for="newTitle">Titre du livre</label></p>
            <p><input type="text" name="newTitle" id="newTitle" value="<?= $book['title']; ?>"></p>
        </div>

        <div>
            <p><label for="newAuthor">Auteur</label></p>
            <p><input type="text" name="newAuthor" id="newAuthor" value="<?= $book['author']; ?>"></p>
        </div>

        <div>
            <p><label for="newYear_publication">Année de publication</label></p>
            <p><input type="text" name="newYear_publication" id="newYear_publication" size="4" value="<?= $book['year_publication']; ?>"></p>
        </div>

        <div>
            <p><label for="newGenre">Genre</label></p>
            <select id="newGenre" name="newGenre">
                <!-- <option value="none">--</option> -->
                <option value="Aventure" <?php if($book['genre'] == "Aventure"){echo "selected";} ?>>Aventure</option>
                <option value="Classique" <?php if($book['genre'] == "Classique"){echo "selected";} ?>>Classique</option>
                <option value="Fantasy" <?php if($book['genre'] == "Fantasy"){echo "selected";} ?>>Fantasy</option>
                <option value="Historique" <?php if($book['genre'] == "Historique"){echo "selected";} ?>>Historique</option>
                <option value="Policier" <?php if($book['genre'] == "Policier"){echo "selected";} ?>>Policier</option>
                <option value="Romance" <?php if($book['genre'] == "Romance"){echo "selected";} ?>>Romance</option>
            </select>
        </div>

        <div>
            <p><label for="newEdition">Nom de l'éditeur</label></p>
            <p><input type="text" name="newEdition" id="newEdition" value="<?= $book['edition']; ?>"></p>
        </div>

        <div>
            <p><label for="newLinkEdition">Lien vers le site de l'éditeur</label></p>
            <p><input type="url" name="newLinkEdition" id="newLinkEdition" value="<?= $book['linkEdition']; ?>"></p>
        </div>

        <div>
            <p><label for="newLocation">Ville où se déroule l'intrigue</label></p>
            <p><input type="text" name="newLocation" id="newLocation" value="<?= $book['location']; ?>"></p>
        </div>
        
        <div>
            <p><label for="newCatchphrase">Accroche de l'article</label></p>
            <textarea name="newCatchphrase" id="newCatchphrase" cols="80" rows="30"> <?= $book['catchphrase']; ?></textarea>
        </div>
        
        <div>
            <p><label for="newContent">Contenu de l'article</label></p>
            <textarea name="newContent" id="newContent" cols="80" rows="30"> <?= $book['content']; ?></textarea>
        </div>

        <div>
            <p><label for="newPicture">Image de la couverture du livre</label></p>
            <p><input type="file" name="newPicture" id="newPicture" value="<?= $book['picture']; ?>" accept=".jpg, .jpeg, .png, .gif, .webp"></p>
        </div>

        <div>
            <p><label for="newNotation">Note du livre</label></p>
            <p><input name="newNotation" id="newNotation" type="range" value="./App/Public/Front/images/<?= $book['notation']; ?>" min="0" max="5" step="1" oninput="this.nextElementSibling.value = this.value">
            <output><?= $book['notation']; ?></output> / 5</p>
        </div>
        
        <input type="submit" value="Enregistrer les modifications">
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>