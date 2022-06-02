<?php $currentPageTitle = "Créer un nouvel administrateur";
 include_once('./App/Views/admin/layouts/head.php'); ?>

<section id="new-admin" class="container text-center">

    <h2>Créer un nouvel administrateur</h2>

    <form action="indexAdmin.php?action=createAdminPost" method="post" enctype='multipart/form-data'>
        <p><input type="text" pattern="^[a-zA-Z0-9]{5,}$" title="Votre pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux" name="adminPseudo" id="pseudo" placeholder="Votre pseudo"></p>
        <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <p><input type="password" pattern="^(?=.{7,})(?=.*[a-z])(?=.*[A-Z])(?=.*[!£@$%^&*()_+=\-`{}:~#';<>?/.,|\\]).*$" title="Votre mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial" name="adminMdp" id="adminMdp" placeholder="Votre mot de passe" value=""></p>
        <p><input type="file" name="picture" id="inputImg" accept="image/*"></p>
        <input type="submit">
    </form>
</section>


<?php include_once('./App/Views/admin/layouts/footer.php');?>