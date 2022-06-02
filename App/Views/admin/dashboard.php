<?php $currentPageTitle = "Tableau de bord";
include_once('./App/Views/admin/layouts/header.php') ; 
?>

<section id="dashboard" class="container-lg">
    <h1>Bienvenue sur votre tableau de bord, <span><?= $_SESSION['pseudo']; ?> !</span></h1>

    <!-- ADMIN DASHBOARD -->
    <?php if($_SESSION['role'] > 0){ ?>
    <div id="stats" class="flex justify-between">
        <!-- Books -->
        <article id="book-stat">
            <h2>Livres</h2>
            <div class="stats" title="Nombre total de livres sur le blog"><?= $datas['nbBooks']; ?></div>
            <div class="last flex col">
                <p class="text-center">Dernier livre ajouté au blog</p>
                <a title="Voir ce livre sur le blog" href="index.php?action=un-livre&id=<?=$datas['lastBook']['id'];?>">
                <p class="text-center"><img src="./App/Public/Books/images/<?=$datas['lastBook']['picture']; ?>" class="cover" alt="Couverture du livre <?=$datas['lastBook']['title']; ?>"></p>
                    <p class="italic text-center">
                    <?= substr($datas['lastBook']['title'], 0, 30); 
                        if(strlen($datas['lastBook']['title']) > 30){echo "[...]";}
                    ?></p>
                </a>
            </div>
        </article>
        <!-- Users -->
        <article id="user-stat">
            <h2>Lecteurs</h2>
            <div class="stats" title="Nombre total de comptes utilisateurs"><?= $datas['nbUsers']; ?></div>
            <div class="last flex col">
                <p class="text-center">Dernier compte utilisateur créé</p> 
                <p class="text-center"><img class="avatar" src="./App/Public/Users/images/<?=$datas['lastUser']['picture']; ?>" alt="Image du profil de <?=$datas['lastUser']['pseudo']; ?>"></p>
                <p class="italic text-center"><?=$datas['lastUser']['pseudo']; ?></p>
            </div>
        </article>
        <!-- Comments -->
        <article id="comments-stat">
            <h2>Commentaires</h2>
            <div class="stats" title="Nombre total de commentaires sur le blog"><?= $datas['nbComments']; ?></div>
            <div class="last">
                <p class="text-center">Dernier commentaire</p>
                <a title="Voir ce commentaire sur le blog" href="index.php?action=un-livre&id=<?=$datas['lastComment']['bookId'];?>#comment<?= $datas['lastComment']['commentId'];?>">
                    <p>Le <?=$datas['lastComment']['created_at']; ?></p>
                    <div class="flex justify-between align-items-center">
                        <p><img class="avatar" src="./App/Public/<?= isset($datas['lastComment']['userPseudo'])? 'Users/images/' . $datas['lastComment']['userPicture'] : 'Admin/images/' . $datas['lastComment']['adminPicture'];?>" alt="Image du profil de <?= isset($datas['lastComment']['userPseudo']) ? $datas['lastComment']['userPseudo'] : $datas['lastComment']['adminPseudo']; ?>"></p>
                        <p><img class="cover" src="./App/Public/Books/images/<?=$datas['lastComment']['bookPicture']; ?>" alt="Couverture du livre <?=$datas['lastComment']['bookTitle']; ?>"></p>
                    </div>
                    <div class="flex justify-between">
                        <p><?= isset($datas['lastComment']['userPseudo']) ? $datas['lastComment']['userPseudo'] : $datas['lastComment']['adminPseudo']; ?></p>
                        <p><?=$datas['lastComment']['bookTitle']; ?></p>
                    </div>
                </a>
            </div>
        </article>
        <!-- Messages -->
        <article id="message-stat">
            <h2>Messages</h2>
            <div class="stats" title="Nombre total de messages reçus"><?= $datas['nbMails']; ?></div>
            <div class="last flex col">
                <p class="text-center">Dernier message</p>
                <a title="Lire le message" href="indexAdmin.php?action=messagesView&id=<?=$datas['lastMail']['id']; ?>">
                    <p>Le <?=$datas['lastMail']['send_at']; ?></p>
                    <p>De la part de : <?=$datas['lastMail']['firstname'] . " " . $datas['lastMail']['familyname']; ?></p>
                    <p>Objet : <?=$datas['lastMail']['object']; ?></p>
                </a>
            </div>
        </article>
    </div>
        
        <!-- USER DASHBOARD -->
        <?php }else{?>
        <div id="stats">
            <article id="comments-stat" class="center">
                <h2>Mes commentaires</h2>
                <div class="stats" title="Nombre total de commentaires sur le blog"><?= $datas['nbComments']; ?></div>
                <?php if(empty($datas['allComments'])){ ?>
                    <p>Vous n'avez pas encore publié de commentaire.</p>
                <?php }else{ ;?>
                <div class="last">
                    <p class="text-center">Dernier commentaire</p>
                    <a title="Voir ce commentaire sur le blog" href="index.php?action=un-livre&id=<?=$datas['lastComment']['bookId'];?>#comment<?= $datas['lastComment']['commentId'];?>">
                        <p>Le <?=$datas['lastComment']['created_at']; ?></p>
                        <div class="flex justify-between align-items-center">
                            <p><img class="avatar" src="./App/Public/Users/images/<?=$datas['lastComment']['userPicture']; ?>" alt="Image du profil de <?=$datas['lastComment']['userPseudo']; ?>"></p>
                            <p><img class="cover" src="./App/Public/Books/images/<?=$datas['lastComment']['bookPicture']; ?>" alt="Couverture du livre <?=$datas['lastComment']['bookTitle']; ?>"></p>
                        </div>
                        <div class="flex justify-between">
                            <p><?=$datas['lastComment']['userPseudo']; ?></p>
                            <p><?=$datas['lastComment']['bookTitle']; ?></p>
                        </div>
                    </a>
                </div>
                <?php } ;?>
            </article>
    </div>
        <?php }; ?>

</section>
<?php include_once('./App/Views/admin/layouts/footer.php');?>