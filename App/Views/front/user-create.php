<?php $currentPageTitle = "Créer un compte";
 include_once('layouts/header.php'); 
?>

<section id="user-connexion" class="container text-center bg-contact">
    <h1>Créer un compte</h1>

    <form action="index.php?action=createUserPost" method="post" enctype='multipart/form-data'>
        <!-- Pseudo -->
        <p class="label"><label for="pseudo">Pseudo<span class="required">*</span></label></p>
        <p class="pattern">Votre pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux</p>
        <p><input type="text" name="userPseudo" id="pseudo" placeholder="Votre pseudo" pattern="^[a-zA-Z0-9]{5,}$" title="Votre pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux" required></p>
        <!-- Email -->
        <p class="label"><label for="mail">Adresse mail<span class="required">*</span></label></p>
        <p><input type="email" name="userMail" id="mail" placeholder="Votre adresse e-mail" required></p>
        <!-- Password -->
        <p class="label"><label for="userMdp">Mot de passe<span class="required">*</span></label></p>
        <p class="pattern">Votre mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial</p>
        <p><input type="password" autocomplete="new-password" name="userMdp" id="userMdp" placeholder="Votre mot de passe" pattern="^(?=.{7,})(?=.*[a-z])(?=.*[A-Z])(?=.*[!£@$%^&*()_+=\-`{}:~#';<>?/.,|\\]).*$" title="Votre mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial" required></p>
        <!-- Picture -->
        <p class="label"><label for="inputImg">Image de profil</label></p>
        <p class="pattern">Taille maximale autorisée : 1 Mo.</p>
        <p><input type="file" name="picture" id="inputImg" accept="image/*"></p>
        <!-- GDPR checkbox -->
        <p class="rgpd">
            <input type="checkbox" name="rgpd" id="rgpd" required><span class="required">* </span>
            <label for="rgpd">En cochant cette case, vous acceptez que les données transmises soient conservées. Aucun traitement commercial n'en sera fait, et elles ne seront pas transmises à des tiers. </label>
            <a class="main" title="Consulter les mentions légales" href="index.php?action=mentions-legales">Plus d'information</a>.
        </p>
        
        <button class="btn btn-main" type="submit">Créer mon compte</button>
    </form>

</section>

<?php include_once('layouts/footer.php'); ?>