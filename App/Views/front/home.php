<?php $currentPageTitle = "Bienvenue au coin des héros voyageurs"; ?>
<?php include_once('layouts/header.php'); ?>





<section id="myCarousel" class="container flex justify-between">
        <a href="/" id="prev"><i class="fa-solid fa-chevron-left"></i></a>

    <div id="carousel" class="text-center">

        <?php  foreach($datas as $data) { 
            if($data['slider'] == 1){ ?>
            <a href="" title="<?= $data['title']; ?>">
                <img src="./App/Public/Books/images/<?= $data['picture']; ?>" />
            </a>
        <?php }}; ?>

    </div>
        <a href="/" id="next"><i class="fa-solid fa-chevron-right"></i></a>

    <!-- <div id="controllers" >
        <a href="/" id="prev"><i class="fa-solid fa-chevron-left"></i></a>
        <a href="/" id="next"><i class="fa-solid fa-chevron-right"></i></a>
    </div> -->
</section>





<section class="container">
    <h1>Bienvenue au Bookshelf Corner, le coin des héros voyageurs</h1>
    <h2>h2jjjjjjjjjjeci est un est une titre</h2>
    <p>Ceci est un paragraphe en 2.5rem.</p>
</section>


<?php include_once('layouts/footer.php'); ?>