<?php
require_once 'config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer les informations du contact à modifier
if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT id, name, phone, email FROM contacts WHERE id = ?');
    $stmt->execute([$contact_id]);
    $contact = $stmt->fetch();
}

// Mettre à jour les informations du contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_contact'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    $stmt = $pdo->prepare('UPDATE contacts SET name = ?, phone = ?, email = ? WHERE id = ?');
    $stmt->execute([$name, $phone, $email, $_POST['contact_id']]);
    header('Location: Contact.php'); // Redirection pour recharger les données
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le contact</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container">
        <h1>Modifier le contact</h1>
        <form method="POST" action="edit_contact.php?id=<?php echo $contact['id']; ?>">
            <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>">
            <input type="text" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
            <button type="submit" name="update_contact">Mettre à jour</button>
        </form>
        <a href="Contact.php">Annuler</a>
    </div>
</body>
</html>
