<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../connection/login.php');
    exit;
}

require_once '../../connection/connexion.php';

$req = $pdo->query("SELECT * FROM produits");
$produits = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les produits</title>
    <link rel="stylesheet" href="../../style/style.css">
    <style>
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1e1e1e;
            color: #eee;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.1);
        }

        .styled-table th,
        .styled-table td {
            padding: 0.75rem;
            border: 1px solid #333;
            text-align: center;
        }

        .styled-table th {
            background-color: #2c2c2c;
            color: #ffd700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .icon-link {
            display: inline-block;
            margin: 0 0.3rem;
            padding: 0.3rem;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .icon-link:hover {
            background-color: #333;
        }

        .icon-link svg {
            vertical-align: middle;
        }

        .add-button {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #ffd700;
            color: #121212;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #e6c200;
        }
    </style>
</head>
<body class="dashboard">

<div class="dashboard-container">
    <h1 class="dashboard-title">Gestion des produits</h1>

    <div style="text-align: right; margin-bottom: 1rem;">
        <a href="ajout.php" class="add-button">➕ Ajouter un produit</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($produits as $prod): ?>
            <tr>
                <td><?= $prod['id'] ?></td>
                <td><?= htmlspecialchars($prod['nom']) ?></td>
                <td><?= number_format($prod['prix'], 2) ?> $</td>
                <td>
                    <?php if (!empty($prod['img'])): ?>
                        <img src="images/uploads/<?= $prod['img'] ?>" alt="Image produit" style="height: 50px;">
                    <?php else: ?>
                        <em style="color: #777;">Aucune</em>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="modifier.php?id=<?= $prod['id'] ?>" class="icon-link" title="Modifier">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffd700" viewBox="0 0 576 512">
                            <path d="M402.3 344.9L233.4 176l112-112L514.3 232.9l-112 112zm-28.2 28.3L83.5 82.6c-5-5-11.7-7.8-18.7-7.8H16C7.2 74.8 0 82 0 90.8v48c0 7 2.8 13.7 7.8 18.7l290.7 290.7c15.6 15.6 41 15.6 56.6 0l63.5-63.5c15.6-15.6 15.6-41 0-56.6z"/>
                        </svg>
                    </a>
                    <a href="supprimer.php?id=<?= $prod['id'] ?>" class="icon-link" title="Supprimer" onclick="return confirm('Supprimer ce produit ?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ff4d4d" viewBox="0 0 448 512">
                            <path d="M135.2 17.7C140.6 7.1 151.2 0 163.2 0H284.8c12 0 22.6 7.1 28 17.7L320 32H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H416l-21.2 372.4c-1.7 29.6-26.2 51.6-55.9 51.6H109.1c-29.7 0-54.2-22-55.9-51.6L32 64H16C7.2 64 0 56.8 0 48s7.2-16 16-16H128l7.2-14.3zM144 96V48h160V96H144z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 2rem;">
        <a href="index.php" class="link">← Retour au tableau de bord</a>
    </div>
</div>

</body>
</html>
