<?php $currentPageTitle = "Erreur";
 include_once('./App/Views/admin/layouts/head.php');?>
    <!-- Div for error management -->
    <?php if(isset($datas['feedback'])) {;?>
            <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
    <?php }; ?>

    <div class="flex justify-evenly align-items-center">
        <a id="history-btn" href="#" class="btn display-none">Page précédente</a>
        <a href="indexAdmin.php" class="btn">Se connecter</a>
    </div>


<script src="./App/Public/Front/js/history.js"></script>

</body>
</html>