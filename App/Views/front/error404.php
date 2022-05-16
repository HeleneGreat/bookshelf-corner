<?php $currentPageTitle = "Erreur 404";
 include_once('./App/Views/front/layouts/head.php'); 
?>
<main>
    <section id="error" class="container">
        <h1>Erreur 404</h1>
        <h2 class="text-center">Une erreur s'est produite, la page demandée n'existe pas !</h2>

        <p id="history-btn" class="text-center center display-none"><a href="#">Page précédente</a></p>
        <p class="text-center center"><a href="index.php">Retourner à l'accueil du blog</a></p>
    </section>
</main>

<script src="./App/Public/Front/js/history.js"></script>

</body>
</html>