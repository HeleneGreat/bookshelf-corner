<?php $currentPageTitle = $datas['book']['title'] . ", mon avis";
include ('layouts/header.php');
?>

<!-- One book presentation -->
<section id="one-book" class="container">
    <h1><?= $datas['book']['title']; ?></h1>
    <article class="flex">
        <div id="info-book">
            <div class="cover">
                <img src="./App/Public/Books/images/<?= $datas['book']['picture']; ?>" alt="Couverture du livre <?= $datas['book']['title']; ?>">
            </div>
            <div class="info">

            </div>
        </div>
        <div id="article-book">
            <p class="catchphrase"><?= $datas['book']['catchphrase']; ?></p>
            <p class="content"><?= $datas['book']['content']; ?></p>
        </div>
   </article>
</section>

<!-- Add a comment form if the user is connected -->
<section id="comments" class="container">
    <h2 class="text-center">Ajouter un commentaire</h2>
    <form action="index.php?action=commentPost&id=<?= $datas['book']['id'];?>" method="POST">
        <label for="title">Titre de votre commentaire</label>
        <input type="text" maxlength="40" name="title">
        <label for="content">Votre commentaire</label>
        <textarea name="content"></textarea>
        <button type="submit" class="btn center">Publier</button>
    </form>
</section>

 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
        <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<!-- All comments about this book -->
<section id="all-comments" class="container">
    <h2 class="text-center">Toutes vos réactions</h2>
    <?php if(empty($datas['comments'])){?>
        <p class="text-center">Soyez le premier à commenter cet article !</p>
    <?php };?>
    <?php foreach ($datas['comments'] as $data){ ?>
        <article id="comment<?= $data['id']; ?>" class="flex-md">
            <div class="user-info">
                <p><img src="./App/Public/Users/images/<?= $data['picture']; ?>" alt="Avatar de <?= $data['pseudo']; ?>"></p>
                <p class="bold pseudo"><?= $data['pseudo']; ?></p>
                <p class="date">Publié le <?= $data['created_at']; ?></p>
            </div>
            <div class="comment">
                <p class="title bold"><?= $data['commentTitle']; ?></p>
                <p class="content"><?= $data['commentContent']; ?></p>
            </div>
        </article>
    <?php }; ?>
</section>

<?php include ('layouts/footer.php')?>