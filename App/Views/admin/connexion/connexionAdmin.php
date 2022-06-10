<?php $currentPageTitle = "Se connecter en tant qu'administrateur";
 include_once('./App/Views/admin/layouts/head.php');?>
  
 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
    <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<section id="admin-connexion" class="container text-center">

    <h1>Se connecter en tant qu'administrateur</h1>

    <form action="indexAdmin.php?action=connexionAdminPost" method="post">
        <fieldset>
            <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
            <p><input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" value=""></p>
            <input type="submit" value="Se connecter">
        </fieldset>
    </form>

</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>