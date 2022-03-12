<?php include_once('./App/Views/admin/layouts/header.php'); ?>

<h1 class="text-center">Bienvenue sur votre tableau de bord, <?= $_SESSION['pseudo']; ?> !</h1>


<p>Nombre total de livres : <?= $nbBooks[0]; ?> </p>


<?php include_once('./App/Views/admin/layouts/footer.php');?>