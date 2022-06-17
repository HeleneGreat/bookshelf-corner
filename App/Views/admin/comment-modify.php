<?php $currentPageTitle = "Modifier mon commentaire";
 include_once('./App/Views/admin/layouts/header.php');?>


<section id="comment-modify" class="container-lg">
    <div class="retour"><a title="Retour" href="indexAdmin.php?action=comments-mine"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1>Modifier mon commentaire</h1> 

    <form action="indexAdmin.php?action=commentModifyPost&id=<?= $datas['id']; ?>" method="POST">
        <!-- Title -->
        <p><label for="title">Titre de votre commentaire</label></p>
        <p><input type="text" maxlength="40" name="title" value="<?= $datas['commentTitle']; ?>"></p>
        <!-- Comment -->
        <p><label for="content">Votre commentaire</label></p>
        <p><textarea name="content"><?= $datas['commentContent']; ?></textarea></p>

        <button class="btn center" type="submit">Enregistrer les modifications</button>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>