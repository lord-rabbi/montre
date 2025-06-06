<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: ../connection/login.php');
    exit;
}

require_once '../../connection/connexion.php';

$stmt = $pdo->query("SELECT * FROM produits ORDER BY id DESC LIMIT 4");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'navbar.php'; ?>

<div class="dashboard-container">
    <h1 class="dashboard-title">Bienvenue sur notre boutique en ligne !</h1>
    <p class="intro-text">Découvrez nos derniers produits sélectionnés avec soin.</p>

    <div class="product-grid">
        <?php foreach ($articles as $article): ?>
            <div class="product-card">
                <?php if (!empty($article['img'])): ?>
                    <img src="../admin/images/uploads/<?= htmlspecialchars($article['img']) ?>" alt="Produit" class="product-image">
                <?php else: ?>
                    <div class="product-placeholder"></div>
                <?php endif; ?>
                <h2 class="product-name"><?= htmlspecialchars($article['nom']) ?></h2>
                <p class="product-desc"><?= htmlspecialchars($article['description']) ?></p>
                <p class="product-price">Prix : <?= number_format($article['prix'], 2) ?> $</p>
                <a href="ajouter_panier.php?id=<?= $article['id'] ?>" class="add-to-cart">Ajouter au panier</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
