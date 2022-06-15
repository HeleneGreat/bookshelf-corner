<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#3786ed">
    <meta name="description" content="<?= $blog['name']; ?> c'est le lieu de rendez-vous de tous les amoureux de la litérature. Bienvenue sur votre espace utilisateur, pour participer activement à la vie du blog !">
    <title><?= $currentPageTitle; ?> | Espace <?= $_SESSION['role'] == 0 ? "utilisateur" : "admin"; ?> | <?= $blog['name']; ?></title>
    <link rel="icon" type="image/x-icon" href="./App/Public/Front/images/puzzle-back.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./App/Public/Admin/css/style.css">
</head>
<body>
