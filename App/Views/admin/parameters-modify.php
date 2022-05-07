<?php $currentPageTitle = "Modifier les paramètres du site";
 include_once('./App/Views/admin/layouts/header.php');?>

<!-- This page is only displayed on the Supra admin account -->

<section id="parameters" class="container-lg">
    <div class="retour"><a href="indexAdmin.php?action=blogParameters"><i class="fas fa-arrow-circle-left"></i></a></div>

    <h1>Modifier les paramètres du site</h1> 

    <form action="indexAdmin.php?action=blogModifyPost" method="POST" enctype="multipart/form-data">
        <p>Titre du blog : <input type="text" name="newBlog" value="<?= $datas['name'];?>"></p>
        <p>Logo actuel du blog : </p>

        <p class="flex justify-center"><img src="./App/Public/Admin/images/<?= $datas['logo'];?>" alt="Logo du site <?= $datas['name'];?>"></p>
        <input type="file" name="picture" id="inputImg" accept="image/*">


        <p id="displayImg" class="display-none">Nouveau logo :</p>
        <p class="flex justify-center"><img class="display-none" src="" id="preview" alt="Logo du site <?= $datas['name'];?>"></p>
       

        <p class="text-center"><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>