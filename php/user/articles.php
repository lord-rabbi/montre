<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: ../connection/login.php');
    exit;
}

require_once '../../connection/connexion.php';

$categoriesStmt = $pdo->query("SELECT DISTINCT categorie FROM produits");
$categories = $categoriesStmt->fetchAll(PDO::FETCH_COLUMN);

$selectedCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;

if ($selectedCategorie && in_array($selectedCategorie, $categories)) {
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE categorie = :categorie ORDER BY id DESC");
    $stmt->execute(['categorie' => $selectedCategorie]);
} else {
    $stmt = $pdo->query("SELECT * FROM produits ORDER BY id DESC");
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Articles par catégorie</title>
    <link rel="stylesheet" href="../../assets/style2.css">
</head>
<body class="dashboard">

<?php include 'navbar.php'; ?>

<div class="dashboard-container">
    <h1 class="dashboard-title">Nos articles</h1>
    <p class="intro-text">Filtrez les produits par catégorie pour affiner votre recherche.</p>

    <form method="GET" class="category-filter">
        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie" onchange="this.form.submit()">
            <option value="">-- Toutes les catégories --</option>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= htmlspecialchars($categorie) ?>" <?= ($selectedCategorie === $categorie) ? 'selected' : '' ?>>
                    <?= htmlspecialchars(ucfirst($categorie)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <section class="product-grid">
        <?php if (count($articles) > 0): ?>
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
        <?php else: ?>
            <p>Aucun article trouvé pour cette catégorie.</p>
        <?php endif; ?>
    </section>
</div>

<footer class="footer">
    <p>&copy; <?= date('Y') ?> Boutique En Ligne. Tous droits réservés à PicAPic.</p>
</footer>

</body>
</html>
