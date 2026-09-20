<?php
require 'includes/config.php';
if (isLogged()) header("Location: me.php");

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($username) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
        $error = "Le pseudo contient des caractères non autorisés.";
    } else {
        // Vérifier si le pseudo existe déjà
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Ce pseudo est déjà pris ! Choisis-en un autre.";
        } else {
            // Hachage du mot de passe (Sécurité)
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            // Look de base du personnage (Noob look)
            $look = 'hd-180-1.ch-210-66.lg-270-82.sh-290-91.ha-1002-1';
            
            $insert = $db->prepare("INSERT INTO users (username, password, look) VALUES (?, ?, ?)");
            if ($insert->execute([$username, $hashed_password, $look])) {
                $success = "Inscription réussie ! Tu peux maintenant te connecter.";
            } else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>KabboRP - Inscription</title>
    <link rel="stylesheet" href="assets/css/habbo.css">
</head>
<body>
    <div class="container">
        <div style="width: 50%;">
            <h1 class="logo">KabboRP</h1>
            <div class="box">
                <h2>Créer un compte</h2>
                <p>C'est gratuit et ça le restera toujours !</p>
                <a href="index.php" class="btn-green" style="background: #888; border-color: #555;">Retour à l'accueil</a>
            </div>
        </div>

        <div style="width: 45%;">
            <div class="box">
                <h3>Formulaire d'inscription</h3>
                
                <?php if($error) echo "<p style='color:red; font-weight:bold;'>$error</p>"; ?>
                <?php if($success) echo "<p style='color:green; font-weight:bold;'>$success</p>"; ?>
                
                <form method="POST">
                    <label>Ton futur pseudo :</label>
                    <input type="text" name="username" placeholder="Pseudo" maxlength="25" required>
                    
                    <label>Mot de passe :</label>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    
                    <label>Confirme ton mot de passe :</label>
                    <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>
                    
                    <button type="submit" name="register" class="btn-green">M'inscrire sur KabboRP</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
