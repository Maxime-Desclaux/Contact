<?php
// Démarrer la session si nécessaire
session_start();

// Récupérer la page demandée, ou 'accueil' par défaut
$page = isset($_GET['route']) ? $_GET['route'] : 'accueil';

// Routeur pour charger la page appropriée
switch ($page) {
    case 'accueil':
        if (file_exists('index.php')) {
            include 'index.php'; // Page d'accueil
        } else {
            echo "Page d'accueil indisponible.";
        }
        break;
    case 'login':
        include 'login.php'; // Page de connexion
        break;
    case 'register':
        include 'register.php'; // Page d'inscription
        break;
    case 'logout':
        include 'logout.php'; // Page de déconnexion
        break;
    case 'forgot_password':
        include 'forgot_password.php'; // Page de mot de passe oublié
        break;
    case 'Contact':
        include 'Contact.php'; // Page des contacts
        break;
    case 'add_contact':
        include 'add_contact.php'; // Page d'ajout de contact
        break;
    case 'edit_contact':
        include 'edit_contact.php'; // Page de modification de contact
        break;
    case 'delete_contact':
        include 'delete_contact.php'; // Page de suppression de contact
        break;
    default:
        include '404.php'; // Page d'erreur si la route n'est pas trouvée
}
