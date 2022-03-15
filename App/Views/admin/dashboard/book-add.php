<?php include_once('./App/Views/admin/layouts/header.php');?>

<section>

    <p class="retour"><a href="indexAdmin.php?action=livres"><i class="fas fa-arrow-circle-left"></i> Retour</a></p>

    <h1 class="text-center">Modifier le livre</h1>

    <form action="indexAdmin.php?action=livresadd" method="post">
        <div class="flex justify-between">
            <div>
                <div>
                    <p><label for="title">Titre du livre</label></p>
                    <p><input type="text" name="title" id="title"></p>
                </div>

                <div>
                    <p><label for="author">Auteur</label></p>
                    <p><input type="text" name="author" id="author"></p>
                </div>

                <div>
                    <p><label for="year_publication">Année de publication</label></p>
                    <p><input type="text" name="year_publication" id="year_publication" size="4"></p>
                </div>

                <div>
                    <p><label for="genre">Genre</label></p>

                    <select id="genre" name="genre">
                        <!-- <option value="none">--</option> -->
                        <option value="Aventure">Aventure</option>
                        <option value="Classique">Classique</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Historique"?>>Historique</option>
                        <option value="Policier">Policier</option>
                        <option value="Romance">Romance</option>
                    </select>
                </div>

                <div>
                    <p><label for="edition">Lien vers le site de l'éditeur</label></p>
                    <p><input type="text" name="edition" id="edition"></p>
                </div>

                <div>
                    <p><label for="linkEdition">Lien vers le site de l'éditeur</label></p>
                    <p><input type="url" name="linkEdition" id="linkEdition"></p>
                </div>

                <div>
                    <p><label for="location">Ville où se déroule l'intrigue</label></p>
                    <p><input type="text" name="location" id="location"></p>
                </div>

                <div>
                    <p><label for="picture">Image de la couverture du livre</label></p>
                    <p><input type="file" name="picture" id="picture" accept=".jpg, .jpeg, .png, .gif, .webp"></p>
                </div>

                <div>
                    <p><label for="notation">Note du livre</label></p>
                    <p><input type="range" min="0" max="5" step="1" value="0" oninput="this.nextElementSibling.value = this.value">
                    <output>0</output> / 5</p>
                </div> 
            </div>
            <div class="zones-text">
                <div>
                    <p><label for="catchphrase">Accroche de l'article</label></p>
                    <textarea class="catchphrase" name="catchphrase" id="catchphrase"></textarea>
                </div>
                
                <div>
                    <p><label for="content">Contenu de l'article</label></p>
                    <textarea class="content" name="content" id="content"></textarea>
                </div>
            </div>
        </div>
            
        
        <p class="text-center"><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>