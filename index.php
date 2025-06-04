<?php
session_start();

// Redirection si déjà connecté
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin.php');
        exit;
    } else {
        header('Location: user.php');
        exit;
    }
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $usersFile = __DIR__ . '/users.json';
    $users = [];

    if (file_exists($usersFile)) {
        $users = json_decode(file_get_contents($usersFile), true);
        if (!is_array($users)) {
            $users = [];
        }
    }

    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];

        if ($_SESSION['role'] === 'admin') {
            header('Location: admin.php');
            exit;
        } else {
            header('Location: user.php');
            exit;
        }
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
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

    <p>Pas encore inscrit ? <a href="../compte.php" style="color:#ffd700;">Créez un compte ici</a></p>
</div>

</body>
</html>
