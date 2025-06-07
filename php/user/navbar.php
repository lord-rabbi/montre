<?php
if (!isset($_SESSION)) session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../../style/style2.css">
</head>
<body class="dashboard">

<nav class="navbar">
    <div class="navbar-brand">PicAPic</div>
    <ul class="nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="#a_propos.php">À propos</a></li>
        <li><a href="articles.php">Articles</a></li>
        <li><a href="panier.php">Panier</a></li>
        <li><a href="../../connection/deconnexion.php" class="logout-link">Déconnexion</a></li>
    </ul>
</nav>

</body>
</html>
