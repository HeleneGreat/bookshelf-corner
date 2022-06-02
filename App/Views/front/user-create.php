<?php $currentPageTitle = "Se connecter à mon compte";
 include_once('layouts/header.php'); 
?>

<section class="container text-center bg-contact">
    <h1>Créer un compte</h1>

    <form action="indexAdmin.php?action=createUserPost" method="post" enctype='multipart/form-data'>
        <p><input type="text" name="userPseudo" id="pseudo" placeholder="Votre pseudo"><span class="required">*</span></p>
        <p><input type="email" name="userMail" id="mail" placeholder="Votre adresse e-mail" pattern="^[a-zA-Z0-9]{5,}$" title="Votre pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux"><span class="required">*</span></p>
        <p><input type="password" name="userMdp" id="userMdp" placeholder="Votre mot de passe" pattern="^(?=.{7,})(?=.*[a-z])(?=.*[A-Z])(?=.*[!£@$%^&*()_+=\-`{}:~#';<>?/.,|\\]).*$" title="Votre mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial"><span class="required">*</span></p>
        <p><input type="file" name="picture" id="inputImg" accept="image/*"></p>
        <button class="btn" type="submit">Créer mon compte</button>
    </form>

</section>

<?php include_once('layouts/footer.php'); ?>