<?php $currentPageTitle = "Bienvenue au coin des héros voyageurs"; ?>
<?php include_once('layouts/header.php'); ?>


<section id="carousel" class="container">
<div id="visible">

<?php
$first = true;
foreach($datas as $data){
    if($data["slider"] == 1){?>
    <article class="<?php if($first) { echo 'selected';}; ?>" id="slider-item-<?=$data['id']?>" onclick="selected(<?=$data['id']?>)">
        <img src="./App/Public/Books/images/<?= $data['picture']; ?>" alt="">
    </article>
    <?php $first = false; ?>

<?php }}; ?>
  
    </div>
</section>


<section class="container">
    <h1>Bienvenue au Bookshelf Corner, le coin des héros voyageurs</h1>
    <h2>h2jjjjjjjjjjeci est un est une titre</h2>
    <p>Ceci est un paragraphe en 2.5rem.</p>
</section>


<?php include_once('layouts/footer.php'); ?>