<?php $currentPageTitle = "Mes commentaires";
include_once('./App/Views/admin/layouts/header.php') ; 
include_once('./App/Views/admin/layouts/header-comments.php');
?>

<section id="dashboard" class="container-lg">
    <div id="all-comments">
        <h1>Mes commentaires</h1>
        <p class="stats">Nombre total de <span class="bold">commentaires</span> publiés : <span class="bold"><?= $datas['nbComments']; ?></span></p>
        <?php if(empty($datas['allComments'])){ ?>
            <p>Vous n'avez pas encore publié de commentaire.</p>
        <?php } ;?>
        <?php foreach($datas['allComments'] as $comment){ ?>
        <article class="flex-md">
            <!-- Comment info -->
            <div class="user-info">
                <p><img src="./App/Public/Books/images/<?= $comment['bookCover']; ?>" alt="Couverture du livre <?= $comment['bookTitle']; ?>"></p>
                <p class="date"><?= $comment['created_at']; ?></p>
                <!-- Action icons -->
                <div class="flex-md actions justify-center">
                    <a title="Voir ce commentaire sur le site" href="index.php?action=un-livre&id=<?=$comment['bookId'];?>#comment<?= $comment['commentId'];?>"><i class="fa-solid fa-eye"></i></a>
                    <a title="Modifier ce commentaire" href="indexAdmin.php?action=commentModify&id=<?= $comment['commentId']; ?>"><i class="fa-solid fa-pencil"></i></a>
                    <a href="indexAdmin.php?action=commentDelete&id=<?= $comment['commentId']; ?>" title="Supprimer ce commentaire" id="btn-delete-<?= $comment['commentId']; ?>" class="btn-delete-this"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            </div>
            <!-- Comment content -->
            <div class="comment">
                <h2 class="title bold"><?= $comment['commentTitle']; ?></h2>
                <p class="content"><?= $comment['commentContent']; ?></p>
            </div>
        </article>

        <!-- DELETE CONFIRMATION MODAL FOR COMMENTS SUPPRESSION -->
        <div id="myModal<?= $comment['commentId']; ?>" class="modal display-none">
            <div class="modal-content text-center">
                <span id="closing-<?= $comment['commentId']; ?>" class="closing close bold">X</span>
                <p><i class="fa-solid fa-trash-can"></i></p>
                <p class="bold">Demande de confirmation</p>
                <p>Êtes-vous sûr de vouloir supprimer ce commentaire ?</p>
                <div class="flex justify-center">
                    <a id="cancel-<?= $comment['commentId']; ?>" class="cancel btn center" title="Retour">Annuler</a>
                    <a href="indexAdmin.php?action=commentDelete&id=<?= $comment['commentId'];?>" title="Supprimer ce commentaire" class="btn center">Supprimer</a>
                </div>
            </div>
        </div>
        <?php }; ?>

        <!-- Navigation -->
        <?php  if(!empty($datas['allComments'])){?>
        <nav>
            <ul id="pagination" class="flex justify-center">
                <!-- Previous page -->
                <li class="<?= ($datas['currentPage'] == 1) ? "display-none" : "" ?>">
                    <a class="controller previous" title="Page précédente" href="indexAdmin.php?action=comments-mine&page=<?= $datas['currentPage'] - 1 ?>">&lt;</a>
                </li>
                <!-- All pages number -->
                <?php for($page = 1; $page <= $datas['pages']; $page++): ?>
                    <li class="<?= ($datas['currentPage'] == $page) ? "bold active" : "not-active" ?>">
                        <a class="nb-page" href="indexAdmin.php?action=comments-mine&page=<?= $page ?>"><?= $page ?></a>
                    </li>
                <?php endfor ?>
                    <!-- Next page -->
                    <li class="<?= ($datas['currentPage'] == $datas['pages']) ? "display-none" : "" ?>">
                    <a class="controller next" title="Page suivante" href="indexAdmin.php?action=comments-mine&page=<?= $datas['currentPage'] + 1 ?>">&gt;</a>
                </li>
            </ul>
        </nav>
        <?php }; ?>
    </div>

</section>
<?php include_once('./App/Views/admin/layouts/footer.php');?>