<?php include_once('./App/Views/admin/layouts/header.php');?>

<section id="book-form" class="container">

    <div class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1 class="text-center">Ajouter un livre</h1>

    <form action="indexAdmin.php?action=livresaddPost" method="post">
        <div class="flex justify-between">
            <div>
            <!-- Book information -->
                <div>
                    <p><label for="newTitle">Titre du livre</label></p>
                    <p><input type="text" name="newTitle" id="newTitle"></p>
                </div>
                <div>
                    <p><label for="newAuthor">Auteur</label></p>
                    <p><input type="text" name="newAuthor" id="newAuthor"></p>
                </div>
                <div>
                    <p><label for="newYear_publication">Année de publication</label></p>
                    <p><input type="text" name="newYear_publication" id="newYear_publication" size="4"></p>
                </div>
                <div>
                    <p><label for="newGenre">Genre</label></p>
                    <select id="newGenre" name="newGenre">
                        <option value="none">--</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Classique">Classique</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Historique">Historique</option>
                        <option value="Policier">Policier</option>
                        <option value="Romance">Romance</option>
                    </select>
                </div>
                <div>
                    <p><label for="newEdition">Nom de l'éditeur</label></p>
                    <p><input type="text" name="newEdition" id="newEdition"></p>
                </div>
                <div>
                    <p><label for="newLinkEdition">Lien vers le site de l'éditeur</label></p>
                    <p><input type="url" name="newLinkEdition" id="newLinkEdition"></p>
                </div>
                <div>
                    <p><label for="newLocation">Ville où se déroule l'intrigue</label></p>
                    <p><input type="text" name="newLocation" id="newLocation"></p>
                </div>
                <div>
                    <p><label>Image de la couverture du livre</label></p>
                    <p><label class="custom-file-upload ajout" for="newPicture"><input type="file" name="newPicture" id="newPicture" accept=".jpg, .jpeg, .png, .gif, .webp"><i class="fas fa-plus-circle"></i> <i class="fas fa-image add-picture"></i></label></p>
                    <p><img src="" alt=""></p>
                </div>
                <div>
                    <p><label for="newNotation">Note du livre</label></p>
                    <p><input name="newNotation" id="newNotation" type="range" min="0" max="5" step="1" value="0" oninput="this.nextElementSibling.value = this.value">
                    <output>0</output> / 5</p>
                </div> 
            </div>

            <!-- Text zones -->
            <div class="zones-text">
                <div>
                    <p><label for="newCatchphrase">Accroche de l'article</label></p>
                    <textarea class="catchphrase" name="newCatchphrase" id="newCatchphrase"></textarea>
                </div>
                <div>
                    <p><label for="newContent">Contenu de l'article</label></p>
                    <textarea class="content" name="newContent" id="newContent"></textarea>
                </div>
            </div>
        </div>
                    
        <p class="text-center"><input type="submit" value="Publier"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>