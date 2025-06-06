<?php
if (!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - E-Commerce</title>
    <link rel="stylesheet" href="../../style/style2.css">
</head>
<body class="dashboard">

<nav class="navbar">
    <div class="navbar-brand">Mon E-Commerce</div>
    <ul class="nav-links">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="a_propos.php">À propos</a></li>
        <li><a href="articles.php">Articles</a></li>
        <li><a href="panier.php">Panier</a></li>
        <li><a href="../../connection/deconnexion.php" class="logout-link">Déconnexion</a></li>
    </ul>
</nav>

<!-- Ton contenu ici -->

</body>
</html>
