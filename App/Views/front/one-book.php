<?php $currentPageTitle = $datas['title'] . ", mon avis"; ?>
<?php include ('layouts/header.php');?>


<section class="container">
    <h1><?= $datas['title']; ?></h1>

    <article class="flex">
        <div id="info-book">
            <div class="cover">
                <img src="./App/Public/Books/images/<?= $datas['picture']; ?>" alt="Couverture du livre <?= $datas['title']; ?>">
            </div>
            <div class="info">

            </div>
        </div>

        <div id="article-book">
            <p class="catchphrase"><?= $datas['catchphrase']; ?></p>
            <p class="content"><?= $datas['content']; ?></p>
        </div>

   </article>
   
</section>






<?php include ('layouts/footer.php')?>