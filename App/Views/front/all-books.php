<?php $currentPageTitle = "Derniers livres lus"; ?>
<?php include ('layouts/header.php');?>


<section id="all-books" class="container">
    <!-- Books per category -->
<?php if(isset($_GET['category']) && $_GET['category'] > 0) { ?>
    <div id="cat" class="flex justify-center align-items-center">
        <p><img src="./App/Public/Books/images/<?= $datas['genre']['picture'] ;?>" alt="<?= $datas['genre']['category'] ;?>"></p>
        <h1>Catégorie <span class="italic"><?= $datas['genre']['category'] ;?></span></h1>
    </div>
<?php if(empty($datas['book'])){?>
    <div class="no-book-cat">
        <p>Nous n'avons pas encore lu de livres de cette catégorie, n'hésitez pas à revenir plus tard !</p>
    </div>
    <!-- All books -->
 <?php }}else{ ?>
    <h1>Les derniers livres que nous avons dévorés</h1>
<?php } ;?>

    <div class="flex-md justify-between-md">
    <?php foreach($datas['book'] as $book){ ?>
        <article class="book-card center flex col justify-between">
            <!-- Book title (first 30 caracters) -->
            <h2 class="text-center"><?= 
            substr($book['title'], 0, 30); 
            if(strlen($book['title']) > 30){echo "[...]";}
            ?></h2>
            <!-- Book category + date -->
            <p class="text-center date">
                <a href="index.php?action=livres&category=<?= $book['genreId'] ;?>">
                    <?php if(isset($_GET['category']) && $_GET['category'] > 0){ ;?>
                        <img title="Catégorie <?= $datas['genre']['category']?>" src="./App/Public/Books/images/<?= $datas['catPicture']?>" alt="Catégorie">
                    <?php }else{ ;?>
                        <img title="Catégorie <?= $book['category']?>" src="./App/Public/Books/images/<?= $book['catPicture']?>" alt="Catégorie <?= $book['category'] ;?>">
                    <?php } ;?>
                </a>
                <?= $book['date'] ?>
            </p>
            <!-- Book cover -->
            <p class="text-center">
                <a href="index.php?action=un-livre&id=<?= $book['id'] ?>">
                    <img src="./App/Public/Books/images/<?= $book['bookPicture']; ?>" alt="La couverture du roman <?= $book['title']; ?>">
                </a>
            </p>
            <!-- Book link -->
            <a href="index.php?action=un-livre&id=<?= $book['id'] ?>" class="center btn-book">Lire l'article</a>
        </article>  
    <?php }; ?>
    </div>
</section>

<!-- Pagination -->
<?php if(!isset($_GET['category']) || $_GET['category'] == 0) { ?>
<nav>
    <ul id="pagination" class="center flex justify-center">
        <!-- Previous page -->
        <li class="<?= ($datas['currentPage'] == 1) ? "display-none" : "" ?> previous">
            <a class="controller " title="Page précédente" href="index.php?action=livres&page=<?= $datas['currentPage'] - 1 ?>"><i class="fa-solid fa-chevron-left"></i></a>
        </li>
        <?php for($page = 1; $page <= $datas['pages']; $page++): ?>
            <!-- All pages number -->
            <li class="<?= ($datas['currentPage'] == $page) ? "bold active" : "not-active" ?>">
                <a class="nb-page" href="index.php?action=livres&page=<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Next page -->
            <li class="<?= ($datas['currentPage'] == $datas['pages']) ? "display-none" : "" ?> next">
            <a class="controller" title="Page suivante" href="index.php?action=livres&page=<?= $datas['currentPage'] + 1 ?>"><i class="fa-solid fa-chevron-right"></i></a>
        </li>
    </ul>
</nav>
<?php } ;?>



<?php include ('layouts/footer.php')?>