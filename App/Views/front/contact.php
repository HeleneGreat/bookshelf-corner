<?php $currentPageTitle = "Nous contacter";
 include_once('layouts/header.php'); 
?>

 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
        <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<section class="container bg-contact">
    <h1>Nous contacter</h1>

    <form action="index.php?action=contactPost" method="post" id="contact-form" class="text-center"> 

        <div class="flex justify-between">
            <div id="contact-left">
                <p class="flex"><input type="radio" name="gender" id="female" value="female" checked="checked">
                <label for="female">Madame</label></p>  
                <p class="flex"><input type="radio" name="gender" id="male" value="male">
                <label for="male">Monsieur</label></p>    
                <p class="flex"><input type="radio" name="gender" id="other" value="other">
                <label for="other">Autre</label></p>

                <p><input type="text" name="familyname" id="familyname" placeholder="Votre nom" required></p>
                <p><input type="text" name="firstname" id="firstname" placeholder="Votre prénom" required></p>
                <p><input type="email" name="email" id="email" placeholder="Votre email" required></p>

               
                    <p><select id="object" name="object" required>
                        <option value="" class="placeholder" selected disabled hidden>Objet de votre message :</option>
                        <option value="Proposer un conseil lecture">Proposer un conseil lecture</option>
                        <option value="Accès à mes données">Accès à mes données</option>
                        <option value="Réclamation">Réclamation</option>
                        <option value="Autre">Autre</option>
                    </select></p>
            </div>

            <div id="contact-right">
                <textarea name="message" placeholder="Votre message..." required></textarea>
            </div>
        </div>
        <p class="rgpd"><input type="checkbox" name="rgpd" required><label for="rgpd">En cochant cette case, vous acceptez que les données transmises soient conservées. Aucun traitement commercial n'en sera fait, et elles ne seront pas transmises à des tiers.</label></p>

        <!-- <p class="center"><input type="submit" class="btn lg"></p> -->
        <button type="submit" class="btn center lg">Envoyer</button>

        <!-- Mobile link to send the message-->
        <button type="submit" id="send-btn" title="Envoyer le message"><img src="./App/Public/Front/images/send-button.png" alt="Envoyer le message"></button>
        
    </form>

</section>

<?php include_once('layouts/footer.php'); ?>