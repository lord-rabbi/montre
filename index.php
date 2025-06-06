<?php
session_start();
require_once 'connection/connexion.php'; 


if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: php/admin/index.php');
        exit;
    } else {
        header('Location: php/user/index.php');
        exit;
    }
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: php/admin/index.php');
            } else {
                header('Location: php/user/index.php');
            }
            exit;
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="login-container">
    <h1>Connexion</h1>

    <?php if ($error): ?>
        <p style="color: #ff5555;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore inscrit ? <a href="php/compte.php" style="color:#ffd700;">Créez un compte ici</a></p>
</div>

</body>
</html>
