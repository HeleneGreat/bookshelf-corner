<?php include_once('./App/Views/admin/layouts/head.php');?>
  
 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
    <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<section id="admin-connexion" class="container text-center">

    <h2>Se connecter en tant qu'administrateur</h2>

    <form action="indexAdmin.php?action=connexionAdminPost" method="post">
        <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <p><input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" value=""></p>

        <input type="submit" value="Se connecter">


    </form>


    <p class="p-btn">Vous n'avez pas de compte ?</p>
    <p class="p-btn"><a class="btn center" href="indexAdmin.php?action=createAccount">Créer un compte administrateur</a></p>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>