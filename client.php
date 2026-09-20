<?php
require 'includes/config.php';
if (!isLogged()) header("Location: index.php");

// Récupération de l'utilisateur
$stmt =$db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user =$stmt->fetch();

// Génération du SSO Ticket (SSO sert à connecter le compte du site vers l'émulateur)
$sso_ticket = 'KabboRP-' . uniqid() . '-' . rand(10000, 99999);

// On met à jour le ticket dans la base de données pour que l'émulateur puisse le lire
$update =$db->prepare("UPDATE users SET auth_ticket = ? WHERE id = ?");
// Note: Il faudra ajouter la colonne `auth_ticket` (varchar 255) dans ta table users
// $update->execute([$sso_ticket,$user['id']]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>KabboRP - Hôtel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000; /* Fond noir typique du client */
            overflow: hidden; /* Empêche de scroller */
        }
        iframe {
            width: 100vw;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>
    <!-- 
    C'est ici que tu devras mettre le lien vers ton Nitro Client (HTML5).
    Le SSO Ticket est passé dans l'URL pour connecter le joueur automatiquement.
    -->
    <iframe src="http://127.0.0.1/nitro/index.html?sso=<?php echo $sso_ticket; ?>"></iframe>
</body>
</html>
