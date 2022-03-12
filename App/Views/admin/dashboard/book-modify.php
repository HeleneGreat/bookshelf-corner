<?php include_once('./App/Views/admin/layouts/header.php');?>

<section>
    <h1>Modifier le livre</h1>

    <form action="">
        <div>
            <p><label for="title">Titre du livre</label></p>
            <p><input type="text" name="title" id="title" value="<?= $book['title']; ?>"></p>
        </div>

        <div>
            <p><label for="author">Auteur</label></p>
            <p><input type="text" name="author" id="author" value="<?= $book['author']; ?>"></p>
        </div>

        <div>
            <p><label for="year_publication">Année de publication</label></p>
            <p><input type="text" name="year_publication" id="year_publication" size="4" value="<?= $book['year_publication']; ?>"></p>
        </div>

        <div>
            <p><label for="genre">Genre</label></p>
            <?= $book['genre']; ?>

            <select id="genre" name="genre">
                <option value="none">--</option>
                <option value="Aventure">Aventure</option>
                <option value="Classique">Classique</option>
                <option value="Fantaisy">Fantaisy</option>
                <option value="Historique">Historique</option>
                <option value="Policier">Policier</option>
                <option value="Romance">Romance</option>
            </select>
        </div>

        <div>
            <p><label for="edition">Lien vers le site de l'éditeur</label></p>
            <p><input type="text" name="edition" id="edition" value="<?= $book['edition']; ?>"></p>
        </div>

        <div>
            <p><label for="linkEdition">Lien vers le site de l'éditeur</label></p>
            <p><input type="url" name="linkEdition" id="linkEdition" value="<?= $book['linkEdition']; ?>"></p>
        </div>

        <div>
            <p><label for="location">Ville où se déroule l'intrigue</label></p>
            <p><input type="text" name="location" id="location" value="<?= $book['location']; ?>"></p>
        </div>
        
        <div>
            <p><label for="catchphrase">Accroche de l'article</label></p>
            <textarea name="catchphrase" id="catchphrase" cols="80" rows="30"> <?= $book['catchphrase']; ?></textarea>
        </div>
        
        <div>
            <p><label for="content">Contenu de l'article</label></p>
            <textarea name="content" id="content" cols="80" rows="30"> <?= $book['content']; ?></textarea>
        </div>

        <div>
            <p><label for="picture">Image de la couverture du livre</label></p>
            <p><input type="file" name="picture" id="picture"></p>
        </div>

        <div>
            <p><label for="notation">Note du livre</label></p>
            <p><input type="range" value="<?= $book['notation']; ?>" min="0" max="5" step="1" oninput="this.nextElementSibling.value = this.value">
            <output><?= $book['notation']; ?></output> / 5</p>
        </div>
        
        <input type="submit" value="Enregistrer les modifications">
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>