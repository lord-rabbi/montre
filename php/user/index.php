<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Utilisateur - Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p><a href="../../connection/deconnexion.php">Se déconnecter</a></p>
</body>
</html>
