<?php $currentPageTitle = "Mon compte";
 include_once('./App/Views/admin/layouts/header.php'); ?>

<section id="account" class="container-lg">
    <h1>Mon compte</h1>
    <div class="flex-md">
        <div>
            <p>Mon image de profil :</p>
            <img src="./App/Public/<?= $_SESSION['role'] > 0 ? "Admin" : "Users" ; ?>/images/<?= $datas['picture']; ?>" alt="Image de profil de <?= $datas['pseudo']; ?>">
        </div>
        <div id="admin-info">
            <p>Mon pseudo : <span class="bold"><?= $datas['pseudo']; ?></span></p>
            <p>Mon adresse mail : <span class="bold"><?= $datas['mail']; ?></span></p>
        </div>
    </div>

        <a href="indexAdmin.php?action=accountModify" class="btn center">Modifer mes informations</a>

</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>