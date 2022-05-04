<?php include_once('./App/Views/admin/layouts/header.php') ; ?>

<section id="dashboard" class="container-lg">
    <h1>Bienvenue sur votre tableau de bord, <span><?= $_SESSION['pseudo']; ?> !</span></h1>

    <!-- Admin dashboard -->
    <?php if($_SESSION['role'] > 0){ ?>
    <div id="stats" class="flex justify-between">
        <!-- Books -->
        <article id="book-stat">
            <h2>Livres</h2>
            <div class="stats" title="Nombre total de livres sur le blog"><?= $datas['nbBooks']; ?></div>
            <p>Dernier livre ajouté au blog :</p>
            <a href="index.php?action=un-livre&id=<?=$datas['lastBook']['id'];?>">
               <p class="text-center"><img src="./App/Public/Books/images/<?=$datas['lastBook']['picture']; ?>" class="cover" alt="Couverture du livre <?=$datas['lastBook']['title']; ?>"></p>
                <p class="italic text-center"><?=$datas['lastBook']['title']; ?></p>
            </a>
        </article>
        <!-- Users -->
        <article id="user-stat">
            <h2>Lecteurs</h2>
            <div class="stats" title="Nombre total de comptes utilisateurs"><?= $datas['nbUsers']; ?></div>
            <p>Dernier compte utilisateur créé :</p> 
            <p class="text-center"><img class="avatar" src="./App/Public/Users/images/<?=$datas['lastUser']['picture']; ?>" alt="Image du profil de <?=$datas['lastUser']['pseudo']; ?>"></p>
            <p class="italic text-center"><?=$datas['lastUser']['pseudo']; ?></p>
        </article>
        <!-- Comments -->
        <article id="comments-stat">
            <h2>Commentaires</h2>
            <div class="stats" title="Nombre total de commentaires sur le blog"><?= $datas['nbComments']; ?></div>
            <p>Dernier commentaire :</p>
            <a title="Voir ce commentaire sur le site" href="index.php?action=un-livre&id=<?=$datas['lastComment']['bookId'];?>#comment<?= $datas['lastComment']['commentId'];?>">
                <p>Le <?=$datas['lastComment']['created_at']; ?></p>
                <div class="flex justify-between align-items-center">
                    <p><img class="cover" src="./App/Public/Books/images/<?=$datas['lastComment']['bookPicture']; ?>" alt="Couverture du livre <?=$datas['lastComment']['bookTitle']; ?>"></p>
                    <p><img class="avatar" src="./App/Public/Users/images/<?=$datas['lastComment']['userPicture']; ?>" alt="Image du profil de <?=$datas['lastComment']['pseudo']; ?>"></p>
                </div>
            </a>
        </article>
        <!-- Messages -->
        <article id="message-stat">
            <h2>Messages</h2>
            <div class="stats" title="Nombre total de messages reçus"><?= $datas['nbMails']; ?></div>
            <p>Dernier message :</p>
            <a title="Lire le message" href="indexAdmin.php?action=messagesView&id=<?=$datas['lastMail']['id']; ?>">
            <p>Le <?=$datas['lastMail']['send_at']; ?></p>
            <p>De la part de : <?=$datas['lastMail']['firstname'] . " " . $datas['lastMail']['familyname']; ?></p>
            <p>Objet : <?=$datas['lastMail']['object']; ?></p>
            </a>
        </article>
    </div>
        
        <!-- User dashboard -->
        <?php }else{ ?>
            <div id="all-comments">
            <p class="stats">Nombre total de <span class="bold">commentaires</span> publiés : <span class="bold"><?= $datas['nbComments']; ?></span></p>
            <?php foreach($datas['allComments'] as $comment){ ?>
                <article class="flex-md">
                    <div class="user-info">
                        <p><img src="./App/Public/Books/images/<?= $comment['bookCover']; ?>" alt="Couverture du livre <?= $comment['bookTitle']; ?>"></p>
                        <p class="date"><?= $comment['created_at']; ?></p>
                        <div class="flex-md actions justify-center">
                            <a title="Voir ce commentaire sur le site" href="index.php?action=un-livre&id=<?=$comment['bookId'];?>#comment<?= $comment['commentId'];?>"><i class="fa-solid fa-eye"></i></a>
                            <a title="Modifier ce commentaire" href="indexAdmin.php?action=commentModify&id=<?= $comment['commentId']; ?>"><i class="fa-solid fa-pencil"></i></a>
                            <a href="indexAdmin.php?action=commentDelete&id=<?= $comment['commentId']; ?>" title="Supprimer ce commentaire" id="btn-delete-<?= $comment['commentId']; ?>" class="btn-delete-this"><i class="fa-regular fa-trash-can"></i></a>
                        </div>
                    </div>
                    <div class="comment">
                        <p class="title bold"><?= $comment['commentTitle']; ?></p>
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
                <nav>
                    <ul id="pagination" class="flex justify-center">
                        <!-- PREVIOUS PAGE -->
                        <li class="<?= ($datas['currentPage'] == 1) ? "display-none" : "" ?>">
                            <a class="controller previous" title="Page précédente" href="indexAdmin.php?action=userDashboard&page=<?= $datas['currentPage'] - 1 ?>"><</a>
                        </li>
                        <!-- ALL PAGES NUMBER -->
                        <?php for($page = 1; $page <= $datas['pages']; $page++): ?>
                            <li class="<?= ($datas['currentPage'] == $page) ? "bold active" : "not-active" ?>">
                                <a class="nb-page" href="indexAdmin.php?action=userDashboard&page=<?= $page ?>"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                            <!-- NEXT PAGE -->
                            <li class="<?= ($datas['currentPage'] == $datas['pages']) ? "display-none" : "" ?>">
                            <a class="controller next" title="Page suivante" href="indexAdmin.php?action=userDashboard&page=<?= $datas['currentPage'] + 1 ?>">></a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php }; ?>

</section>
<?php include_once('./App/Views/admin/layouts/footer.php');?>