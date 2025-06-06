<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../connection/login.php');
    exit;
}

include '../../connection/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = $_POST['nom'] ?? '';
    $d = $_POST['description'] ?? '';
    $p = $_POST['prix'] ?? 0;
    $imgPath = null;

    if (!empty($_FILES['img']['name']) && $_FILES['img']['error'] === 0) {
        $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $newName = uniqid('pr_') . '.' . $ext;
        $dir = __DIR__ . '/images/uploads/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $dest = $dir . $newName;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $dest)) {
            $imgPath = $newName; 
        }
    }

    $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix, img) VALUES (?, ?, ?, ?)");
    $stmt->execute([$n, $d, $p, $imgPath]);

    header('Location: gestion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajout produit</title>
    <link rel="stylesheet" href="../../style/style.css" />
</head>
<body class="dashboard">

<div class="dashboard-container">
    <h1 class="dashboard-title">Ajouter un produit</h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" placeholder="Nom" required>
        <textarea name="description" placeholder="Description" rows="4" required></textarea>
        <input type="number" step="0.01" name="prix" placeholder="Prix" required>
        <label for="img">Image (optionnelle)</label>
        <input type="file" name="img" id="img" accept="image/*">

        <button type="submit" style="margin-top: 1rem;">Ajouter</button>
    </form>

    <div style="text-align:center; margin-top:2rem;">
        <a href="index.php" class="link" style="padding:0.5rem 1rem; background:#ffd700; color:#121212; border-radius:4px; font-weight:bold; text-decoration:none;">
            ← Retour
        </a>
    </div>
</div>

</body>
</html>
