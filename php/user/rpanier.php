<?php
session_start();
if (isset($_GET['index'])) {
    $i = intval($_GET['index']);
    if (isset($_SESSION['panier'][$i])) {
        unset($_SESSION['panier'][$i]);
        $_SESSION['panier'] = array_values($_SESSION['panier']);
    }
}
header('Location: panier.php');
exit;
