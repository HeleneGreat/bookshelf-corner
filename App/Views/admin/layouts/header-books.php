<?php if($_SESSION['role'] > 0){ ?>
<header>
    <nav id="nav-secondary" class="nav-books">
        <ul class="flex justify-between text-center">
            <li><i class="fa-solid fa-book-open"></i>Livres<a title="Tous les livres publiés" href="indexAdmin.php?action=livres"></a></li>
            <li><i class="fa-solid fa-list-ul"></i>Genres<a title="Toutes les catégories de lectures" href="indexAdmin.php?action=livres-genres"></a></li>
            <li><i class="fa-solid fa-sliders"></i>A la Une<a title="Les livres à la Une en page d'accueil" href="indexAdmin.php?action=livres-slider"></a></li>
        </ul>
    </nav>
</header>
<?php } ;?>