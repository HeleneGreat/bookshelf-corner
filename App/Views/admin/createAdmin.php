<?php include_once('./App/Views/admin/layouts/header.php'); ?>

<section id="new-admin" class="center">

<h2>Créer un nouvel administrateur</h2>

    <form action="indexAdmin.php?action=createAdminPost" method="post">
        <p><input type="text" name="adminPseudo" id="pseudo" placeholder="Votre pseudo"></p>
        <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <p><input type="password" name="adminMdp" id="adminMdp" placeholder="Votre mot de passe" value=""></p>

        <input type="submit">


    </form>
</section>


<?php include_once('./App/Views/admin/layouts/footer.php');?>