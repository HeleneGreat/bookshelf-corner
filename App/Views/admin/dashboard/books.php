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
    <?php foreach($datas as $book){ 
        if(isset($book['title'])){
        ?> 
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
    <?php }} ?> 
</section>

<!-- Category Tab -->
<section id="book-cat" class="display-none">
    <?php foreach($datas as $book){ 
        if(isset($book['type'])){
            if($book['type'] != "--"){
        ?> 
        <article class="one-cat">
            <div class="flex">
                <div class="flex">
                    <div class="cat-img text-center">
                        <img src="./App/Public/Books/images/<?= $book['icon']; ?>" alt="Genre : <?= $book['type']; ?>">
                    </div>
                    <p class="list-title"><?= $book['type']; ?></p>
                </div>
                <div class="flex cat-link">
                    <a onclick="genreModify(<?= $book['id']; ?>)"><i class="fa-solid fa-pencil"></i></a>
                    <a href="indexAdmin.php?action=genreDelete&id=<?= $book['id']; ?>"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            </div>
            <form id="modify<?= $book['id']; ?>" action="indexAdmin.php?action=genreModifyPost&id=<?= $book['id']; ?>" method="post" enctype="multipart/form-data" class="flex display-none">
                <label for="picture" class="custom-file-upload-cat ajout">
                    <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une icône" title="Ajouter une icône">
                    <input type="file" name="picture" id="inputImg<?= $book['id']; ?>" accept="image/*" class="">
                </label>
                <p><input type="text" name="newType" id="newType" required placeholder="Nouveau titre de genre"></p>
                <div class="cat-submit">
                    <p><input type="submit" value="Modifier"></p>
                </div>
            </form>
        </article>
    <?php }}} ?> 

    <article id="book-form" class="text-center">
        <h2>Ajouter une nouvelle catégorie</h2>
        <form action="indexAdmin.php?action=genreAddPost" method="post" enctype="multipart/form-data">
            <div>
                <p><label for="newType">Genre littéraire :</label></p>
                <p><input type="text" name="newType" id="newType" ></p>
            </div>
            <div>
                <p id="displayImg">Icône :</p>
                <label for="picture" class="custom-file-upload-cat ajout center">
                    <img src="./App/Public/Admin/images/picture.png" alt="Ajouter une icône" title="Ajouter une icône">
                    <input type="file" name="picture" id="inputImg" accept="image/*">
                </label>
            </div>
            <p><input type="submit" value="Ajouter"></p>
        </form>
    </article>
</section>

<!-- Slider Tab -->
<section id="book-slider" class="display-none">    
    <form action="indexAdmin.php?action=book-slider" method="POST">
        <?php 
        foreach($datas as $book){
            if(isset($book['title'])){
            ?> 
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
        <?php }} ?> 
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