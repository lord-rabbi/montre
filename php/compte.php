<?php
session_start();
require_once '../connection/connexion.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Vérifier si username existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = "Ce nom d'utilisateur est déjà pris.";
        } else {
            // Insérer l'utilisateur
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hash])) {
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Inscription</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="login-container">
    <h1>Inscription</h1>

    <?php if ($error): ?>
        <p style="color: #ff5555;"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
        <p style="color: #55ff55;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà inscrit ? <a href="../index.php" style="color:#ffd700;">Connectez-vous ici</a></p>
</div>

</body>
</html>
