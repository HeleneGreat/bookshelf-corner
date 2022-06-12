<?php $currentPageTitle = "Erreur";
 include_once('./App/Views/admin/layouts/head.php');?>

<section class="container">
    <!-- Div for error management -->
    <?php if(isset($datas['feedback'])) {;?>
            <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
    <?php }; ?>

    <h1>Oups, une erreur s'est produite.</h1>
    <p>Veuillez nous en excuser.</p>
    <p>Vous pouvez nous la signaler grâce au formulaire de contact.</p>

    <div class="flex justify-evenly align-items-center">
        <a id="history-btn" href="#" class="btn display-none">Page précédente</a>
        <a href="indexAdmin.php" class="btn">Se connecter</a>
    </div>

</section>
<script src="./App/Public/Front/js/history.js"></script>

</body>
</html>