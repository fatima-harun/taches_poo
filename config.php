<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "taches.php";
require_once "priorite.php";
require_once "statut.php";

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Juin1706-*2000');
// define('DB_PASSWORD', 'Juin1706-*2000');
define('DB_NAME', 'taches');

try {
    // Connexion à la base de données en utilisant PDO
    $connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    // Gestion des erreurs de connexion à la base de données
    die("Erreur : Impossible de se connecter à la base de données " . $e->getMessage());
}