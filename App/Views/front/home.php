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

<section class="container display-none">
    <h2 class="text-center">Nos catégories de lecture</h2>
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

<div id="home-banner">
    <img src="./App/Public/Front/images/livre-devant-bibliotheque.png" alt="">
    <div class="banner-link">
        <h3>Voir tous nos articles</h3>
        <a href="index.php?action=livres" class="btn">Accéder</a>
    </div>
</div>

<section id="home-about" class="container">
    <h2 class="text-center">Une histoire de...</h2>
    <div class="flex-md justify-between">
        <div class="story text-center">
            <img src="./App/Public/Front/images/voyages.png" alt="Un globe terrestre">
            <h3>voyages</h3>
            <p>L'exploration d'un nouvel univers se cache peut-être à la page suivante. Que cette page soit faite de papier ou de pixels, n'attendons plus pour la tourner !</p>
        </div>
        <div class="story text-center">
            <img src="./App/Public/Front/images/rencontres.png" alt="Un chapeau d'aventurier">
            <h3>rencontres</h3>
            <p>Avec des personnages tous plus originaux les uns que les autres, la littérature n'a pas fini de nous surprendre</p>
        </div>
        <div class="story text-center">
            <img src="./App/Public/Front/images/reves.png" alt="La lune et les étoiles">
            <h3>rêves</h3>
            <p>Quand l'imaginaire n'a plus de limite, le réel s'élargit et nos rêves les plus fous sont envisageables. Les frontières sont repoussées et tout devient alors possible...</p>
        </div>
    </div>
</section>


<?php include_once('layouts/footer.php'); ?>