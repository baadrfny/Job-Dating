<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'job_dating');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Configuration de l'application
define('SITE_NAME', 'Job Dating');
define('SITE_URL', 'http://localhost/job_dating/');

// Démarrer la session si pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fonctions utilitaires
function redirect($url) {
    header("Location: $url");
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}