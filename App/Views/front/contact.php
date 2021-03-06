<?php $currentPageTitle = "Nous contacter";
 include_once('layouts/header.php'); 
?>

<section id="contact" class="container">
    <h1>Nous contacter</h1>

    <form action="index.php?action=contactPost" method="post" id="contact-form" class="text-center"> 

        <div class="flex justify-between">
            <div id="contact-left">
                <!-- Gender -->
                <fieldset>
                    <legend class="display-none">Genre</legend>
                    <p class="flex"><input type="radio" name="gender" id="female" value="female" checked="checked">
                    <label for="female">Madame</label></p>  
                    <p class="flex"><input type="radio" name="gender" id="male" value="male">
                    <label for="male">Monsieur</label></p>    
                    <p class="flex"><input type="radio" name="gender" id="other" value="other">
                    <label for="other">Autre</label></p>
                </fieldset>
                <!-- Identity -->
                <p class="label"><label for="familyname">Votre nom<span class="required">*</span></label><input type="text" name="familyname" id="familyname" placeholder="Votre nom" required></p>
                <p class="label"><label for="firstname">Votre prénom<span class="required">*</span></label><input type="text" name="firstname" id="firstname" placeholder="Votre prénom" required></p>
                <p class="label"><label for="email">Votre adresse mail <span class="required">*</span></label><input type="email" name="email" id="email" placeholder="Votre email" required></p>

                <!-- Message object selection -->
                <p class="label"><label for="object">L'objet de votre message<span class="required">*</span></label></p>
                <p class="left"><select id="object" name="object" required>
                    <option value="" class="placeholder" selected disabled hidden>Objet de votre message :</option>
                    <option value="Proposer un conseil lecture">Proposer un conseil lecture</option>
                    <option value="Accès à mes données">Accès à mes données</option>
                    <option value="Réclamation">Réclamation</option>
                    <option value="Autre">Autre</option>
                </select></p>
            </div>

            <!-- Message content -->
            <div id="contact-right">
                <p class="label"><label for="message">Votre message<span class="required">*</span></label></p>
                <textarea class="left" name="message" id="message" placeholder="Votre message..." required></textarea>
            </div>
        </div>
        <!-- GDPR checkbox -->
        <p class="rgpd"><input type="checkbox" id="rgpd" name="rgpd" required><label for="rgpd"><span class="required">*</span> En cochant cette case, vous acceptez que les données transmises soient conservées. Aucun traitement commercial n'en sera fait, et elles ne seront pas transmises à des tiers. <a class="main" title="Consulter les mentions légales" href="index.php?action=mentions-legales">Plus d'information</a>.</label></p>

        <!-- XL screens link to send the message-->
        <button type="submit" class="btn btn-main center lg">Envoyer</button>

        <!-- Mobile link to send the message-->
        <button type="submit" id="send-btn" title="Envoyer le message"><img src="./App/Public/Front/images/send-button.png" alt="Envoyer le message"></button>
        
    </form>

</section>

<?php include_once('layouts/footer.php'); ?>