<?php
require 'includes/config.php';
if (!isLogged()) header("Location: index.php");

// Récupérer les infos à jour du joueur
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>KabboRP - <?php echo htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" href="assets/css/habbo.css">
</head>
<body>
    <div style="background: #222; color: white; padding: 10px;">
        KabboRP | Connecté en tant que <?php echo htmlspecialchars($user['username']); ?> | 
        <a href="logout.php" style="color: #ccc;">Déconnexion</a>
    </div>

    <div class="container">
        <div style="width: 60%;">
            <div class="box">
                <div style="display: flex; align-items: center;">
                    <!-- Générateur d'avatar Habbo officiel -->
                    <img src="https://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $user['look']; ?>&size=l&direction=2&head_direction=3" class="avatar-image" alt="Avatar">
                    <div style="margin-left: 20px;">
                        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                        <p><i><?php echo htmlspecialchars($user['motto']); ?></i></p>
                        <br>
                        <a href="client.php" class="btn-green" style="font-size: 24px; padding: 15px 30px;">ENTRER DANS KABBORP</a>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 35%;">
            <div class="box">
                <h3>Ton Portefeuille</h3>
                <p><strong>Crédits :</strong> <?php echo $user['credits']; ?> 🪙</p>
            </div>
        </div>
    </div>
</body>
</html>
