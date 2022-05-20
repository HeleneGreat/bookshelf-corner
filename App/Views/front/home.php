<?php $currentPageTitle = "Bienvenue au coin des héros voyageurs"; ?>
<?php include_once('layouts/header.php');?>





<section class="container">
    <h1>Bienvenue sur le blog des héros voyageurs !</h1>
</section>

<section id="myCarousel" class="container flex justify-between">
        <a href="/" id="prev" title="Précédent"><i class="fa-solid fa-chevron-left"></i></a>

    <div id="carousel" class="text-center">

        <?php  foreach($datas as $data) { 
            if($data['slider'] == 1){ ?>
            <a href="index.php?action=un-livre&id=<?= $data['id'] ;?>" title="<?= $data['title']; ?>">
                <img src="./App/Public/Books/images/<?= $data['picture']; ?>" />
            </a>
        <?php }}; ?>

    </div>
        <a href="/" id="next" title="Suivant"><i class="fa-solid fa-chevron-right"></i></a>

</section>

<section class="container">
    <h2 class="text-center">Nos catégories de livres</h2>
    <div id="cat-grid">
        <?php foreach($genres as $genre){ ;?>
        <a href="index.php?action=livres&category=<?= $genre['id'] ;?>">
            <div class="grille flex col">
                <p><img src="./App/Public/Books/images/<?= $genre['picture'] ;?>" alt="<?= $genre['category'] ;?>"></p>
                <p><?= $genre['category'] ;?></p>
            </div>
        </a>
        <div class="grille-empty display-none md"><p></p></div>
        <?php } ;?>
    </div>
</section>


<?php include_once('layouts/footer.php'); ?>