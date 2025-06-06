<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../connection/login.php');
    exit;
}

require_once '../../connection/connexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gestion.php');
    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    echo "<p style='color:red; text-align:center;'>Produit introuvable.</p>";
    echo "<p style='text-align:center;'><a href='gestion.php'>← Retour</a></p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $desc = $_POST['description'] ?? '';
    $prix = $_POST['prix'] ?? 0;
    $imgPath = $produit['img'];

    if (!empty($_FILES['img']['name']) && $_FILES['img']['error'] === 0) {
        $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $newName = uniqid('pr_') . '.' . $ext;

        $uploadDir = __DIR__ . '/images/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $fullPath = $uploadDir . $newName;

        if (move_uploaded_file($_FILES['img']['tmp_name'], $fullPath)) {
            $oldImagePath = $uploadDir . $produit['img'];
            if (!empty($produit['img']) && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $imgPath = $newName;
        }
    }

    $stmt = $pdo->prepare("UPDATE produits SET nom = ?, description = ?, prix = ?, img = ? WHERE id = ?");
    $stmt->execute([$nom, $desc, $prix, $imgPath, $id]);

    header("Location: gestion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier produit</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body class="dashboard">

<div class="dashboard-container">
    <h1 class="dashboard-title">Modifier un produit</h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" placeholder="Nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>
        <textarea name="description" placeholder="Description" rows="4" required><?= htmlspecialchars($produit['description']) ?></textarea>
        <input type="number" step="0.01" name="prix" placeholder="Prix" value="<?= htmlspecialchars($produit['prix']) ?>" required>

        <label for="img">Changer l’image (optionnel)</label>
        <input type="file" name="img" id="img" accept="image/*">

        <?php if (!empty($produit['img'])): ?>
            <p>Image actuelle :</p>
            <img src="images/uploads/<?= htmlspecialchars($produit['img']) ?>" alt="Image produit" style="height: 80px; margin-bottom: 1rem;">
        <?php endif; ?>

        <button type="submit" style="margin-top: 1rem;">Enregistrer</button>
    </form>

    <div style="text-align:center; margin-top:2rem;">
        <a href="gestion.php" class="link" style="padding:0.5rem 1rem; background:#ffd700; color:#121212; border-radius:4px; font-weight:bold; text-decoration:none;">
            ← Retour
        </a>
    </div>
</div>

</body>
</html>
