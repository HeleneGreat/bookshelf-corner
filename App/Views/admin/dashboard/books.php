<?php include_once('./App/Views/admin/layouts/header.php');?>

Liste des livres


<?php foreach($books as $book){ ?>

    <?= $book->title; ?>
<?php }; ?>

<p>Nombre total de livres : <?= $book->count; ?></p>

<?php include_once('./App/Views/admin/layouts/footer.php');?>