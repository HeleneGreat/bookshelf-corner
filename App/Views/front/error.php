<?php $currentPageTitle = "Oups, une erreur s'est produite";
 include_once('layouts/header.php'); 
?>

<section id="error">
    <!-- Div for error management -->
    <?php if(isset($datas['feedback'])) {;?>
        <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
    <?php }; ?>
</section>



<?php include_once('layouts/footer.php'); ?>