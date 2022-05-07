
    </main>
</div>

<footer id="foot-admin">


</footer>
<script src="App/Public/Admin/js/nav-active.js"></script>
<script src="App/Public/Admin/js/nav-responsive.js"></script>
<script src="App/Public/Admin/js/confirmation-modal.js"></script>
<script src="App/Public/Admin/js/input-img.js"></script>

<?php if ($currentPageTitle == "Toutes les catégories"){ ?>
    <script src="App/Public/Admin/js/genre-modify.js"></script>
<?php } ;?>

<?php if ($currentPageTitle == "Ajouter un livre"  || $currentPageTitle == "Modifier le livre"){ ?>
    <script src="App/Public/Admin/js/character-count.js"></script>
    <script src="App/Public/Admin/js/input-range.js"></script>
<?php } ;?>

</body>

</html>