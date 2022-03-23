<?php $currentPageTitle = "Nous contacter"; ?>
<?php include_once('layouts/header.php'); ?>



<section class="container bg-contact">
    <h1>Nous contacter    <i class="fas fa-arrow-circle-right"></i></h1>

    <form action="" method="post" id="contact-form" class="text-center"> 

        <div class="flex justify-between">
            <div class="contact-left">
                <p class="flex"><input type="radio" name="gender" id="female" value="female" checked="checked" checked="checked">
                <label for="female">Madame</label></p>  
                <p class="flex"><input type="radio" name="gender" id="male" value="male">
                <label for="male">Monsieur</label></p>    
                <p class="flex"><input type="radio" name="gender" id="other" value="other">
                <label for="other">Autre</label></p>

                <p><input type="text" name="familyname" id="familyname" placeholder="Votre nom"></p>
                <p><input type="text" name="firstname" id="firstname" placeholder="Votre prénom"></p>
                <p><input type="email" name="email" id="email" placeholder="Votre email"></p>
            </div>

            <div class="contact-right">
                <textarea name="message" placeholder="Votre message..."></textarea>
            </div>

        </div>

        

        <input type="reset" class="btn-small lg">
        <input type="submit" class="btn lg">

        <!-- Mobile link to send the message-->
        <button type="submit" id="send-btn"><img src="./App/Public/Front/images/send-button.png" alt="Envoyer le message"></button>
        
    </form>

</section>

<?php include_once('layouts/footer.php'); ?>