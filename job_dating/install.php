<?php
// Script d'installation simple
echo "<h1>Installation Job Dating</h1>";

// Vérifier les prérequis
if (version_compare(PHP_VERSION, '7.4.0') < 0) {
    die("PHP 7.4 ou supérieur est requis.");
}

if (!extension_loaded('mysqli')) {
    die("L'extension MySQLi est requise.");
}

// Vérifier les permissions des dossiers
$folders = ['controllers', 'models', 'views', 'assets/css', 'assets/js'];
foreach ($folders as $folder) {
    if (!is_dir($folder) && !mkdir($folder, 0755, true)) {
        echo "Erreur: Impossible de créer le dossier $folder<br>";
    }
}

echo "<p>Structure des dossiers créée avec succès.</p>";
echo "<p>N'oubliez pas de :</p>";
echo "<ol>";
echo "<li>Configurer la base de données dans config.php</li>";
echo "<li>Importer le fichier SQL dans votre base de données</li>";
echo "<li>Modifier les paramètres dans .htaccess si nécessaire</li>";
echo "</ol>";
echo "<p><a href='?page=home'>Accéder au site</a></p>";