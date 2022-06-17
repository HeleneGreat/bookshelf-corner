<?php $currentPageTitle = "Se connecter en tant qu'administrateur";
 include_once('./App/Views/admin/layouts/head.php');?>
  
 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
    <div class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<section id="admin-connexion" class="container text-center">
    <a href="index.php" class="btn"><i class="fas fa-arrow-left"></i> Retourner au blog</a>

    <h1>Se connecter en tant qu'administrateur</h1>

    <form action="indexAdmin.php?action=connexionAdminPost" method="post">
        <fieldset>
            <!-- Email -->
            <p class="label"><label>Adresse mail</label></p>
            <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
            <!-- Password -->
            <p class="label"><label>Mot de passe</label></p>
            <p><input type="password" autocomplete="new-password" name="mdp" id="mdp" placeholder="Votre mot de passe" value=""></p>
            
            <input type="submit" value="Se connecter">
        </fieldset>
    </form>


</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>