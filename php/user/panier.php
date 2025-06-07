<?php
session_start();
$panier = $_SESSION['panier'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body class="dashboard">

<div class="dashboard-container">
    <h1 class="dashboard-title">Mon Panier</h1>

    <?php if (empty($panier)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Image</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $index => $article): 
                    $sousTotal = $article['prix'] * $article['quantite'];
                    $total += $sousTotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($article['nom']) ?></td>
                    <td><img src="../admin/images/uploads/<?= htmlspecialchars($article['img']) ?>" width="60"></td>
                    <td><?= number_format($article['prix'], 2) ?> $</td>
                    <td><?= $article['quantite'] ?></td>
                    <td><?= number_format($sousTotal, 2) ?> $</td>
                    <td>
                        <a href="rpanier.php?index=<?= $index ?>" class="remove-btn">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Total : <?= number_format($total, 2) ?> $</h2>
    <?php endif; ?>

    <div style="margin-top:2rem;">
        <a href="articles.php" class="link">← Continuer mes achats</a>
    </div>
</div>

</body>
</html>
