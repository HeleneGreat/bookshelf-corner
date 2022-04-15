<?php include_once('./App/Views/admin/layouts/head.php'); ?>

<section id="new-admin" class="container text-center">

<h2>Créer un nouvel administrateur</h2>

    <form action="indexAdmin.php?action=createAdminPost" method="post" enctype='multipart/form-data'>
        <p><input type="text" name="adminPseudo" id="pseudo" placeholder="Votre pseudo"></p>
        <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <p><input type="password" name="adminMdp" id="adminMdp" placeholder="Votre mot de passe" value=""></p>
        <p><input type="file" name="picture" id="inputImg" accept="image/*"></p>
        <input type="submit">


    </form>
</section>


<?php include_once('./App/Views/admin/layouts/footer.php');?>