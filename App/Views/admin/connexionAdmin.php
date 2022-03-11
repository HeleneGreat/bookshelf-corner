


<?php include_once('./App/Views/admin/layouts/header.php');?>

<section id="new-admin" class="center">

<h2>Se connecter en tant qu'administrateur</h2>

    <form action="indexAdmin.php?action=connexionAdminPost" method="post">
        <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <p><input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" value=""></p>

        <input type="submit" value="Se connecter">


    </form>

    <br>
    <hr>
    <p class="p-btn">Vous n'avez pas de compte ?</p>
    <p class="p-btn"><a class="btn" href="indexAdmin.php?action=createAccount">Créer un compte administrateur</a></p>
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>