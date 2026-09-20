<?php
session_start();

$host = '127.0.0.1';
$dbname = 'kabborp';
$user = 'root'; // Change si ton panel a un autre utilisateur
$pass = '';     // Change si tu as un mot de passe MySQL

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Fonction pour vérifier si l'utilisateur est connecté
function isLogged() {
    return isset($_SESSION['user_id']);
}
?>
