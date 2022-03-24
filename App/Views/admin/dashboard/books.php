<?php include_once('./App/Views/admin/layouts/header.php');?>


<section id="all-books">

    <h1 class="text-center">Livres</h1>

    <?php foreach($datas as $book){ ?> 
    <a href="indexAdmin.php?action=livresview&id=<?= $book['id']; ?>">
        <article class="flex">
            <img src="./App/Public/Books/images/<?= $book['picture']; ?>" alt="Couverture <?= $book['title']; ?>">
            <div>
                <p class="list-title"><?= $book['title']; ?></p>
                <p class="list-location"><?= $book['location']; ?></p>
                <p class="list-date"><?= $book['created_at']; ?></p>
            </div>
        </article>
    </a>
    <?php } ?> 


</section>


<!-- Quick link to add a new book -->
<!-- <?php if((strpos($_SERVER['REQUEST_URI'], "action") == true)){
    if(($_GET['action'] != "livresadd") ) { ?> -->
<a href="indexAdmin.php?action=livresadd">
    <div class="add-btn mobile-btn">
        <img src="./App/Public/Admin/images/book-light.png" alt="">
    </div>
</a>
<!-- <?php }} ?> -->







<!-- VERSION 1 TABLEAU -->
<section style="display:none;">
<h1>Liste des livres</h1>

<p class="ajout"><a href="indexAdmin.php?action=livresadd"><i class="fa-solid fa-circle-plus"></i> Ajouter un livre</a></p>

<table>
    <!-- entêtes -->
    <thead>
        <tr>
            <th>Titre du livre</th>
            <th>Lieu de l'intrigue</th>
            <th>Date de publication de l'article</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datas as $book){ ?>   
        <tr>
            <td><?= $book['title']; ?></td>
            <td><?= $book['location']; ?></td>
            <td><?= $book['created_at']; ?></td>
            <td>
                <a href="indexAdmin.php?action=livresview&id=<?= $book['id']; ?>" title="Voir les détails de l'article">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
            </a></td>
            <td>
                <a href="indexAdmin.php?action=livresmodify&id=<?= $book['id']; ?>" title="Modifier l'article">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </a>
            </td>
            <td>
                <a href="indexAdmin.php?action=livresdelete&id=<?= $book['id']; ?>" title="Supprimer l'article">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </a>
            </td>
        </tr>
        <?php }; ?>
    </tbody>
</table>
</section>

    



<?php include_once('./App/Views/admin/layouts/footer.php');?>