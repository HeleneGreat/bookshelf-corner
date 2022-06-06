<?php $currentPageTitle = "Créer un nouvel administrateur";
 include_once('./App/Views/admin/layouts/head.php'); ?>

<!-- Div for error management -->
<?php if(isset($datas['feedback'])) {;?>
    <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<section id="new-admin" class="container text-center">

    <h2>Créer un nouvel administrateur</h2>

    <form action="indexAdmin.php?action=createAdminPost" method="post" enctype='multipart/form-data'>
        <p><input type="text" pattern="^[a-zA-Z0-9]{5,}$" title="Votre pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux" name="adminPseudo" id="pseudo" placeholder="Votre pseudo"></p>
        <p><input type="email" name="adminMail" id="mail" placeholder="Votre adresse e-mail" value=""></p>
        <p><input type="password" pattern="^(?=.{7,})(?=.*[a-z])(?=.*[A-Z])(?=.*[!£@$%^&*()_+=\-`{}:~#';<>?/.,|\\]).*$" title="Votre mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial" name="adminMdp" id="adminMdp" placeholder="Votre mot de passe" value=""></p>
        <p><input type="file" name="picture" id="inputImg" accept="image/*"></p>
        <p class="rgpd"><input type="checkbox" name="rgpd" required><span class="required">*</span><label for="rgpd">En cochant cette case, vous acceptez que les données transmises soient conservées. Aucun traitement commercial n'en sera fait, et elles ne seront pas transmises à des tiers. <a class="dashboard" title="Consulter les mentions légales" href="index.php?action=mentions-legales">Plus d'information</a>.</label></p>
        <input type="submit">
    </form>
</section>


<?php include_once('./App/Views/admin/layouts/footer.php');?>