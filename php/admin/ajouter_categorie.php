<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../connection/login.php');
    exit;
}
include '../../connection/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newCat = trim($_POST['categorie']);
    if (!empty($newCat)) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO categories (nom) VALUES (?)");
        $stmt->execute([$newCat]);
    }
    header('Location: gestion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body class="dashboard">

<div class="dashboard-container">
    <h1 class="dashboard-title">Ajouter une catégorie</h1>

    <form method="POST">
        <input type="text" name="categorie" placeholder="Nom de la catégorie" required>
        <button type="submit">Ajouter</button>
    </form>

    <div style="margin-top: 2rem;">
        <a href="index.php" class="link">← Retour</a>
    </div>
</div>

</body>
</html>
