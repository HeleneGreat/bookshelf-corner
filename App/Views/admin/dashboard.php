<?php

include_once('./App/Views/admin/layouts/header.php');
var_dump($datas[0]);die;
?>

<section id="dashboard">
    <h1>Bienvenue sur votre tableau de bord, <span><?= $_SESSION['pseudo']; ?> !</span></h1>

    <div class="flex justify-around">
        <?php if($_SESSION['role'] >0){ ?>
        <p>Nombre total de <span class="bold">livres</span> : <span class="bold"><?= $datas[0]; ?></span></p>
        <p>Nombre total de <span class="bold">messages</span> reçus : <span class="bold"><?= $datas[1]; ?></span></p>
        <?php }else{ ?>
        <p>Nombre total de <span class="bold">commentaires</span> publiés : <span class="bold"><?= $datas[0]; ?></span></p>
        <?php }; ?>
    </div>

</section>
<?php include_once('./App/Views/admin/layouts/footer.php');
?>