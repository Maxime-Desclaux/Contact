<?php
require_once 'config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer les informations de contact pour l'utilisateur connecté
$stmt_contacts = $pdo->prepare('SELECT id, name, phone, email FROM contacts WHERE user_id = ?');
$stmt_contacts->execute([$_SESSION['user_id']]);
$contacts = $stmt_contacts->fetchAll();

// Ajouter un contact
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_contact'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    
    if (!empty($name) && !empty($phone) && !empty($email)) {
        try {
            // Ajouter le contact avec l'ID de l'utilisateur
            $stmt = $pdo->prepare('INSERT INTO contacts (name, phone, email, user_id) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $phone, $email, $_SESSION['user_id']]);
            header('Location: Contact.php'); // Redirection pour recharger la liste des contacts
            exit;
        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout du contact : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

// Supprimer un contact
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ? AND user_id = ?');
    $stmt->execute([$id, $_SESSION['user_id']]);
    header('Location: Contact.php'); // Redirection pour recharger la liste des contacts
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container">
        <h1>Informations de Contact</h1>
        <p>Connecté en tant que : <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
        <nav>
            <a href="logout.php">Déconnexion</a>
        </nav>

        <!-- Section pour afficher la liste des contacts -->
        <h2>Liste des contacts</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contact['name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                    <td>
                        <a href="edit_contact.php?id=<?php echo $contact['id']; ?>">Modifier</a>
                        <a href="Contact.php?delete=<?php echo $contact['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Formulaire pour ajouter un contact -->
        <h2>Ajouter un contact</h2>
        <form method="POST" action="Contact.php">
            <div>
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" placeholder="Nom" required>
            </div>
            <div>
                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" placeholder="Téléphone" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <button type="submit" name="add_contact">Ajouter</button>
        </form>

        <!-- Affichage des messages d'erreur -->
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
