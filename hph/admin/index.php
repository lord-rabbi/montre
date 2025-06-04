<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Admin</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue Admin</h1>
        <p>Vous êtes connecté en tant qu’administrateur.</p>
        <a href="logout.php"><button>Déconnexion</button></a>
    </div>
</body>
</html>
