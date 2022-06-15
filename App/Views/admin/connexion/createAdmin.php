<?php $currentPageTitle = "Créer un nouvel administrateur";
 include_once('./App/Views/admin/layouts/header.php'); ?>


<section id="new-admin" class="text-center center">

    <h1>Créer un nouvel administrateur</h1>

    <form action="indexAdmin.php?action=createAdminPost" method="post" enctype='multipart/form-data'>
        <fieldset>
            <p class="label"><label for="pseudo">Pseudo</label> <span class="required">*</span></p>
            <p class="pattern">Le pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux</p>
            <p><input type="text" pattern="^[a-zA-Z0-9]{5,}$" title="Le pseudo doit contenir au moins 5 caractère et n'accepte pas les caractères spéciaux" name="adminPseudo" id="pseudo" placeholder="Pseudo" required></p>
            <p class="label"><label for="mail">Adresse mail</label> <span class="required">*</span></p>
            <p><input type="email" name="adminMail" id="mail" placeholder="Adresse e-mail" value="" required></p>
            <p class="label"><label for="adminMdp">Mot de passe</label> <span class="required">*</span> </p>
            <p class="pattern">Le mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial</p>
            <p><input type="password" autocomplete="new-password" pattern="^(?=.{7,})(?=.*[a-z])(?=.*[A-Z])(?=.*[!£@$%^&*()_+=\-`{}:~#';<>?/.,|\\]).*$" title="Le mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un caractère spécial" name="adminMdp" id="adminMdp" placeholder="Mot de passe" value="" required></p>
            <p class="label"><label for="inputImg">Image de profil</label> <span class="required">*</span></p>
            <p class="pattern">Taille maximale autorisée : 1 Mo.</p>
            <p><input type="file" name="picture" id="inputImg" accept="image/*" required></p>
            <p class="confirmation"><span class="required">Êtes-vous sûr</span> de vouloir ajouter ce compte à la liste des administrateurs du site ? Il ou elle aura accès à l'ensemble de ses contenus (articles, commentaires, messages...). Ne donnez ce genre de droit qu'à des <span class="required">personnes de confiance</span>. Le nouvel administrateur est fortement encouragé à changer son mot de passe.</p>
            <p><span class="required">*</span>  <label><input type="checkbox" name="confirmation" required> Oui</label></p>
        </fieldset>
        
        <input type="submit">
    </form>
</section>


<?php include_once('./App/Views/admin/layouts/footer.php');?>