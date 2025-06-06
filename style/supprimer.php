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

$stmt = $pdo->prepare("SELECT img FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header('Location: gestion.php');
    exit;
}

if (!empty($produit['img'])) {
    $imagePath = __DIR__ . '/images/' . $produit['img'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

$stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
$stmt->execute([$id]);

header('Location: gestion.php');
exit;
