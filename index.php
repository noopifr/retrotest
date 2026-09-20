<?php
require 'includes/config.php';
if (isLogged()) header("Location: me.php");

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['look'] = $user['look'];
        header("Location: me.php");
        exit;
    } else {
        $error = "Pseudo ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>KabboRP - Crée ton avatar, décore ton appart !</title>
    <link rel="stylesheet" href="assets/css/habbo.css">
</head>
<body>
    <div class="container">
        <div style="width: 50%;">
            <h1 class="logo">KabboRP</h1>
            <div class="box" style="background: rgba(255,255,255,0.9);">
                <h2>Rejoins la communauté !</h2>
                <p>KabboRP est un monde virtuel où tu peux te faire des amis, créer des apparts et jouer à des jeux.</p>
                <a href="register.php" class="btn-green">Inscris-toi gratuitement</a>
            </div>
        </div>

        <div style="width: 35%;">
            <div class="box">
                <h3>Connexion</h3>
                <?php if($error) echo "<p style='color:red; font-weight:bold;'>$error</p>"; ?>
                <form method="POST">
                    <input type="text" name="username" placeholder="Ton pseudo" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <button type="submit" name="login" class="btn-green">Entrer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
