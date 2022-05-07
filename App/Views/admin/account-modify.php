<?php $currentPageTitle = "Modifier mon compte";
include_once('./App/Views/admin/layouts/header.php');?>

<section id="account" class="container-lg">
    <div class="retour"><a href="indexAdmin.php?action=account"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1>Modifier mon compte</h1>

    <form action="indexAdmin.php?action=accountModifyPost&id=<?= $datas['id']; ?>" method="post" enctype='multipart/form-data'>
        <div class="flex-md justify-between">
            <div>
                <p>Mon image de profil :</p>
                <img src="./App/Public/Admin/images/<?= $datas['picture']; ?>" alt="Image de profil de <?= $datas['pseudo']; ?>">
            </div>
            <div>
                <p id="displayImg" class="display-none">Nouvelle image de profil :</p>
                <p class="flex justify-center"><img class="display-none" src="" id="preview" alt="Photo de profil de <?= $datas['pseudo'];?>"></p>
                <input type="file" name="picture" id="inputImg" accept="image/*">
            </div>
        </div>
        <div class="flex-md justify-between">
            <div>
                <p><label for="newPseudo">Mon pseudo :</label></p>
                <p><input type="text" name="newPseudo" id="newPseudo" value="<?= $datas['pseudo']; ?>"></p>
                <p><label for="newMail">Mon adresse mail :</label></p>
                <p><input type="text" name="newMail" id="newMail" value="<?= $datas['mail']; ?>"></p>
            </div>
            <div>
                <p><label for="actualPsw">Mon mot de passe actuel :</label></p>
                <p><input type="password" name="actualPsw"></p>
                <p><label for="newPsw">Nouveau mot de passe :</label></p>
                <p><input type="password" name="newPsw"></p>
            </div>
        </div>

        <p class="text-center"><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>