<?php include_once('./App/Views/admin/layouts/head.php');?>

 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
        <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<div>
    <a href="indexAdmin.php" class="btn center">Se connecter</a>
</div>