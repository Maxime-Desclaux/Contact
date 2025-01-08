<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id']; // Récupération de l'ID utilisateur

// Traitement du formulaire d'ajout de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $user_id = trim($_POST['user_id']);
    // Vérifier si les champs sont remplis
    if (!empty($name) && !empty($phone) && !empty($email)) {
        try {
            // Ajout d'un nouveau contact
            $stmt = $pdo->prepare('INSERT INTO contacts (name, phone, email, user_id) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $phone, $email, $user_id]);
            $message = 'Contact ajouté avec succès.';
        } catch (PDOException $e) {
            $message = 'Erreur lors de l\'ajout du contact : ' . $e->getMessage();
        }
    } else {
        $message = 'Tous les champs sont obligatoires.';
    }

    // Redirection
    header('Location: Contact.php?message=' . urlencode($message));
    exit;
}
?>
