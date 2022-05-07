<?php $currentPageTitle = "Paramètres du site";
 include_once('./App/Views/admin/layouts/header.php');?>

<!-- This page is only displayed on the Supra admin account -->

<section id="parameters" class="container-lg">

    <h1>Paramètres du site</h1> 
    <p>Titre du blog : <span class="bold"><?= $datas['name'];?></span></p>
    <p>Logo du blog : </p>
    <p class="flex justify-center"><img src="./App/Public/Admin/images/<?= $datas['logo'];?>" alt="Logo du site <?= $datas['name'];?>"></p>

    <div class="flex-md justify-center">
        <a href="indexAdmin.php?action=blogModify" class="btn center">Modifier les informations du blog</a>
        <a href="" class="btn center">Ajouter un compte administrateur</a>
    </div>
</section>




<?php include_once('./App/Views/admin/layouts/footer.php');?>