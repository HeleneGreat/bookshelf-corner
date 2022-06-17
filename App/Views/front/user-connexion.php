<?php $currentPageTitle = "Se connecter à mon compte";
 include_once('layouts/header.php'); 
?>

<section id="user-connexion" class="container text-center">
    
    <h1>Se connecter à mon compte</h1>

    <form action="index.php?action=connexionUserPost" method="post">
        <!-- Email -->
        <p><label for="mail">Adresse mail</label></p>
        <p><input type="email" name="userMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <!-- Password -->
        <p><label for="mdp">Mot de passe</label></p>
        <p><input type="password" autocomplete="new-password" name="userMdp" id="mdp" placeholder="Votre mot de passe" value=""></p>

        <button class="btn btn-main" type="submit">Se connecter</button>
    </form>

    <div class="unregistered">
        <p>Vous n'avez pas de compte ?</p>
        <p><a class="btn btn-main center" href="index.php?action=createUser">Créer un compte</a></p>
    </div>
</section>

<?php include_once('layouts/footer.php'); ?>