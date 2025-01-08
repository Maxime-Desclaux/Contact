<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        // Hachage du nouveau mot de passe
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $update = $pdo->prepare('UPDATE users SET password = ? WHERE username = ?');
        $update->execute([$hashed_password, $username]);

        $success = "Mot de passe réinitialisé avec succès.";
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container">
        <h1>Réinitialisation du mot de passe</h1>
        <form method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" required><br>
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" name="new_password" required><br>
            <button type="submit">Réinitialiser</button>
        </form>
        <?php
        if (isset($success)) echo "<p style='color: green;'>$success</p>";
        if (isset($error)) echo "<p style='color: red;'>$error</p>";
        ?>
        <p><a href="login.php">Retour à la connexion</a></p>
    </div>
</body>
</html>
