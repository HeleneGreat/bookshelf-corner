<?php $currentPageTitle = "Qui sommes-nous ?"; ?>
<?php include_once('layouts/header.php'); ?>

<section id="about">
    <h1>Qui sommes-nous ?</h1>

    <!-- Biography -->
    <article class="container">
        <h2>Avant tout de grands lecteurs !</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam dignissimos cumque voluptas ducimus? Eveniet, delectus cum asperiores dicta dolorum nesciunt voluptas iure beatae exercitationem sequi earum inventore deleniti, facere iusto vero quasi. Reiciendis <span class="main">minima deleniti dolorum</span> repudiandae, officiis quo adipisci sit. Blanditiis eos, neque nihil, numquam quo fugit reiciendis architecto eius, id aperiam tenetur vel expedita! Vitae tenetur necessitatibus, facere ipsum beatae sit quam accusantium optio laboriosam odio temporibus nulla neque facilis assumenda au quisquam, ad aliquam sed tempora perspiciatis dolores libero saepe.</p>
        <img class="float" src="./App/Public/Front/images/pile-of-books.png" alt="Une grande pile de livres">
        <p>Incidunt <span class="main">veniam sapiente</span> dolorum excepturi enim deserunt iste nesciunt aspernatur molestias fuga sint, saepe molestiae rem. Pariatur itaque suscipit expedita fugiat minima <span class="main">corrupti aspernatur cupiditate</span> quam culpa tempore, temporibus sequi optio atque, rem provident quia nobistem vero architecto voluptas. Autem, quaerat. Nemo laudantium corrupti ab sapiente. Sint cum animi accusantium temporibus nostrum rerum totam!</p>
        <p>Reiciendis minima deleniti dolorum quos quibusdam natus iusto molestias ullam, corrupti sint repellendus exercitationem repudiandae, <span class="main">officiis quo adipisci sit</span>. Blanditiis eos, neque nihil, numquam quo fugit reiciendis architecto eius, id aperiam tenetur vel expedita et aspernatur perspiciatis! <span class="main">Vitae</span> tenetur necessitatibus, facere ipsum beatae sit quam accusantium optio laboriosam, ad aliquam sed tempora perspiciatis dolores libero saepe. Incidunt veniam sapiente dolorum excepturi enim deserunt iste nesciunt aspernatur molestias fuga sint, saepe molestiae rem. <span class="main">Pariatur itaque suscipit expedita fugiat minima corrupti aspernatur</span> cupiditate quam culpa tempore, temporibus sequi optio atque, rem provident quia nobis voluptas. Autem, quaerat. Nemo laudantium corrupti ab sapiente. Sint cum animi accusantium temporibus nostrum rerum totam!</p>
    </article>

    <!-- Background quote -->
    <div class="quote">
        <div class="text-box flex col justify-center">
            <h3 class="center"><i class="fa-solid fa-quote-left"></i> Les lectures sont les véritables événements de la vie.<i class="fa-solid fa-quote-right"></i></h3>
            <p class="center">Jorge Luis Borges</p>
        </div>
    </div>

    <!-- Administrators list -->
    <article>
        <h2 class="text-center">Qui sont les rédacteurs de ce blog ?</h2>
        <p class="container">Une sacrée bande de lecteurs et lectrices <span class="main">passionné.e.s</span> ! Tous se sont donnés pour mission de vous transmettre les émotions et <span class="main">l'amour des histoires</span> qu'ils ont dévorées, et espèrent qu'elles vous plairont autant qu'à eux.</p>
        <div class="container flex justify-between">
        <?php foreach($datas as $admin){ ;?>
            <div class="admin-card center flex col justify-evenly align-items-center">
                <h3 class="text-center"><?= $admin['pseudo'] ;?></h3>
                <img src="./App/Public/Admin/images/<?= $admin['picture']; ?>" alt="La photo de profil de <?= $admin['pseudo']; ?>, l'un de nos talentueux rédacteurs" class="text-center">
            </div>
        <?php } ;?>
        </div>
    </article>
    
</section>
<?php include_once('layouts/footer.php'); ?>