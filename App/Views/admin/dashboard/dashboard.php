<?php include_once('./App/Views/admin/layouts/header.php'); ?>


<section id="dashboard" class="container">
    <h1 class="text-center">Bienvenue sur votre tableau de bord,<br><?= $_SESSION['pseudo']; ?> !</h1>


    <p>Nombre total de livres : <?= $datas[0]; ?> </p>

</section>
<?php include_once('./App/Views/admin/layouts/footer.php');?>