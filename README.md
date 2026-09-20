# KabboRP - CMS 🏨

Bienvenue sur le dépôt officiel du CMS de **KabboRP**, un projet de Rétro Habbo basé sur le RolePlay.
Ce CMS est codé en PHP natif (PDO) avec un design classique inspiré de l'âge d'or d'Habbo Hotel.

## 🚀 Fonctionnalités
- [x] Inscription sécurisée (hachage bcrypt)
- [x] Connexion par session PHP
- [x] Page d'accueil (Me page) avec affichage de l'avatar en temps réel
- [x] Structure de Client prête pour intégration Nitro (HTML5)
- [x] Protection contre les injections SQL (Requêtes préparées PDO)

## 📁 Architecture
- `index.php` : Page de connexion
- `register.php` : Page d'inscription
- `me.php` : Espace membre
- `client.php` : Lancement du jeu
- `/includes/config.php` : Configuration base de données
- `/assets/css/habbo.css` : Feuille de style "Pixel Art"

## 🛠️ Installation
1. Clonez ce dépôt sur votre serveur web (XAMPP/WAMP/VPS).
2. Créez une base de données MySQL nommée `kabborp`.
3. Importez la table SQL suivante :
```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `motto` varchar(50) DEFAULT 'Nouveau sur KabboRP !',
  `credits` int(11) DEFAULT 5000,
  `look` varchar(255) DEFAULT 'hd-180-1.ch-210-66.lg-270-82.sh-290-91.ha-1002-1',
  `rank` int(1) DEFAULT 1,
  `auth_ticket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);
