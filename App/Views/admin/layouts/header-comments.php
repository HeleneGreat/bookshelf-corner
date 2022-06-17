<!-- Comment sub-menu => 2 tabs -->

<?php if($_SESSION['role'] > 0){ ?>
<header>
    <nav id="nav-secondary" class="nav-comments">
        <ul class="flex justify-between text-center">
            <!-- All comments on blog -->
            <li><i class="fa-solid fa-comments"></i>Commentaires des lecteurs<a title="Voir les commentaires des utilisateurs" href="indexAdmin.php?action=comments"></a></li>
            <!-- This admin's comments -->
            <li><i class="fa-solid fa-comment"></i>Mes commentaires<a title="Voir mes commentaires" href="indexAdmin.php?action=comments-mine"></a></li>
        </ul>
    </nav>
</header>
<?php } ?>