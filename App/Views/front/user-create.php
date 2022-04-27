<?php $currentPageTitle = "Se connecter à mon compte";
 include_once('layouts/header.php'); 
?>

<section class="container text-center bg-contact">
    <h1>Créer un compte</h1>

    <form action="indexAdmin.php?action=createUserPost" method="post" enctype='multipart/form-data'>
        <p><input type="text" name="userPseudo" id="pseudo" placeholder="Votre pseudo"><span class="required">*</span></p>
        <p><input type="email" name="userMail" id="mail" placeholder="Votre adresse e-mail"><span class="required">*</span></p>
        <p><input type="password" name="userMdp" id="userMdp" placeholder="Votre mot de passe"><span class="required">*</span></p>
        <p><input type="file" name="picture" id="inputImg" accept="image/*"></p>
        <button class="btn" type="submit">Créer mon compte</button>
    </form>

</section>

<?php include_once('layouts/footer.php'); ?>