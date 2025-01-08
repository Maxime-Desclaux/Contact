<?php
require_once 'config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupérer l'ID du contact
$contact_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Supprimer le contact
$stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ? AND user_id = ?');
$stmt->execute([$contact_id, $user_id]);

// Rediriger vers la page des contacts
header('Location: Contact.php');
exit;

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: contacts.php'); // Redirection pour recharger les données
    exit;
}
