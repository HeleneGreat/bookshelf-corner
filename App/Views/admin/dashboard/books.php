<?php include_once('./App/Views/admin/layouts/header.php');?>

<header>
    <nav id="nav-books">
        <ul class="flex justify-between text-center">
            <li id="all-books-link" class="active"><i class="fa-solid fa-book-open"></i>Livres</li>
            <li id="book-cat-link"><i class="fa-solid fa-list-ul"></i>Genres</li>
            <li id="book-slider-link"><i class="fa-solid fa-sliders"></i>Slider</li>
        </ul>
    </nav>
</header>

<!-- Books Tab -->
<section id="all-books" class="">
    <?php foreach($datas as $book){ ?> 
        <article class="flex">
            <img src="./App/Public/Books/images/<?= $book['picture']; ?>" alt="Couverture <?= $book['title']; ?>">
            <div>
                <p class="list-title"><?= $book['title']; ?></p>
                <p class="list-location"><?= $book['location']; ?></p>
                <p class="list-date"><?= $book['created_at']; ?></p>
            </div>
            <div class="flex book-link">
                <a href="indexAdmin.php?action=livresview&id=<?= $book['id']; ?>" class="stretched-link"><i class="fa-solid fa-eye"></i></a>
                <a href="indexAdmin.php?action=livresmodify&id=<?= $book['id']; ?>"><i class="fa-solid fa-pencil lg"></i></a>
                <a href="indexAdmin.php?action=livresdelete&id=<?= $book['id']; ?>"><i class="fa-regular fa-trash-can lg"></i></a>
            </div>
        </article>
    <?php } ?> 
</section>

<!-- Category Tab -->
<section id="book-cat" class="display-none">
<h2 class="text-center">Genres littéraires</h2>

</section>

<!-- Slider Tab -->
<section id="book-slider" class="display-none">    
    <form action="indexAdmin.php?action=book-slider" method="POST">
        <?php foreach($datas as $book){ ?> 
        <article class="flex justify-between align-items-center">
            <div class="flex">
                <img src="./App/Public/Books/images/<?= $book['picture']; ?>" alt="Couverture <?= $book['title']; ?>">
                <p class="list-title"><?= $book['title']; ?></p>
            </div>
            <div class="switch">
                <input type="checkbox" name="slider<?= $book['id']; ?>" value="<?= $book['id']; ?>" <?php if($book['slider'] == "1"){ echo "checked";} ?>>
                <span class="slide"></span>
            </div>
        </article>
        <?php } ?> 
        <p class="text-center"><input type="submit" value="Enregistrer"></p>
    </form>  
</section>

<!-- Link to add a new book -->
<div class="flex justify-end">
    <a href="indexAdmin.php?action=livresadd" title="Ajouter un nouveau livre">
        <div class="add-btn thumb-btn">
            <img src="./App/Public/Admin/images/book-white.png" alt="Ajouter un nouveau livre">
        </div>
    </a>
</div>




<?php include_once('./App/Views/admin/layouts/footer.php');?>