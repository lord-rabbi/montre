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

    <section class="hero-section">
        <h1 class="dashboard-title">Bienvenue sur notre boutique en ligne !</h1>
        <p class="intro-text">Découvrez des produits soigneusement sélectionnés pour vous offrir le meilleur.</p>
        <a href="#produits" class="cta-button">Voir les nouveautés</a>
    </section>

    <section id="produits" class="product-grid">
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
    </section>

    <section id="a_propos.php" class="about-section">
        <h2 class="dashboard-title">À propos de nous</h2>
        <p class="about-text">
            Notre boutique en ligne a été créée pour vous offrir une sélection de produits de qualité, accessibles en quelques clics.
        </p>
        <p class="about-text">
            Chaque produit est choisi avec soin pour vous garantir satisfaction, originalité et fiabilité. Nous nous engageons à proposer un service rapide, humain et transparent.
        </p>
        <p class="about-text">
            Merci de faire partie de notre aventure. N'hésitez pas à revenir régulièrement pour découvrir nos nouveautés.
        </p>
    </section>

</div>

<footer class="footer">
    <p>&copy; <?= date('Y') ?> Boutique En Ligne. Tous droits réservés à PicAPic.</p>
    <p>
        <a href="#apropos">À propos</a> |
        <a href="#">Contact</a>
        
    </p>
</footer>

</body>
</html>
