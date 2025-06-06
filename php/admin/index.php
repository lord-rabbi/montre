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
    <meta charset="UTF-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="../../style/style.css" />
</head>
<body>

<div class="dashboard-container">
    <h1 class="dashboard-title">Bienvenue Admin <?= htmlspecialchars($_SESSION['username']) ?></h1>

    <div class="card-grid">
        <a href="ajout.php" class="card" aria-label="Ajouter un produit">
            <div class="icon" aria-hidden="true">
                <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6H4v12h16V6zM4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z"/><path d="M8 8h8v2H8zM8 11h8v2H8zM8 14h5v2H8z"/></svg>
            </div>
            Ajouter un produit
        </a>

        <a href="gestion.php" class="card" aria-label="Gérer les produits">
            <div class="icon" aria-hidden="true">
                <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"><path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h12v2H3v-2z"/></svg>
            </div>
            Gérer les produits
        </a>

        <a href="../../connection/deconnexion.php" class="card" aria-label="Se déconnecter">
            <div class="icon" aria-hidden="true">
                <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"><path d="M10.09 15.59L8.67 17l5 5 5-5-1.41-1.41L14 18.17V4h-2v14.17z"/></svg>
            </div>
            Se déconnecter
        </a>
    </div>
</div>

</body>
</html>
