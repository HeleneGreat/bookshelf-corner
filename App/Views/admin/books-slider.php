<?php $currentPageTitle = "Le carousel en page d'accueil";
    include_once('./App/Views/admin/layouts/header.php');
    include_once('./App/Views/admin/layouts/header-books.php');

?>

<!-- Slider Tab -->
<section id="book-slider">    
    <form action="indexAdmin.php?action=sliderModifyPost" method="POST">
        <?php 
        foreach($datas as $book){
            if(isset($book['title'])){
            ?> 
        <article class="flex justify-between align-items-center">
            <div class="flex">
                <img src="./App/Public/Books/images/<?= $book['bookPicture']; ?>" alt="Couverture <?= $book['title']; ?>">
                <h2 class="list-title"><?= $book['title']; ?></h2>
            </div>
            <div class="switch">
                <input title="Ajouter ou enlever du slider" type="checkbox" name="slider<?= $book['id']; ?>" value="<?= $book['id']; ?>" <?php if($book['slider'] == "1"){ echo "checked";} ?>>
                <span class="slide"></span>
            </div>
        </article>
        <?php }} ?> 
        <p class="text-center"><input type="submit" value="Enregistrer"></p>
    </form>  
</section>

<?php include_once('./App/Views/admin/layouts/footer.php');?>