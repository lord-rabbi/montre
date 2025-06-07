<?php
session_start();
require_once '../../connection/connexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, nom, prix, img FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$trouve = false;
foreach ($_SESSION['panier'] as &$item) {
    if ($item['id'] == $produit['id']) {
        $item['quantite']++;
        $trouve = true;
        break;
    }
}
unset($item);

if (!$trouve) {
    $_SESSION['panier'][] = [
        'id' => $produit['id'],
        'nom' => $produit['nom'],
        'prix' => $produit['prix'],
        'quantite' => 1,
        'img' => $produit['img']
    ];
}

header('Location: panier.php');
exit;
