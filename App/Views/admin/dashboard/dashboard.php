<?php include_once('./App/Views/admin/layouts/header.php'); ?>


<section id="dashboard">
    <h1 class="text-center">Bienvenue sur votre tableau de bord,<br><?= $_SESSION['pseudo']; ?> !</h1>

    <div class="flex justify-around">
        <p>Nombre total de <span class="bold">livres</span> : <span class="bold"><?= $datas[0]; ?></span></p>
        <p>Nombre total de <span class="bold">messages</span> reçus : <span class="bold"><?= $datas[1]; ?></span></p>
    </div>

</section>
<?php include_once('./App/Views/admin/layouts/footer.php');?>