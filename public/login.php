<?php
session_start();
if (isset($_SESSION['user'])) {header('Location: index.php'); exit();}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./styles/auth.css"><body>
</head>
<body>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <?php
            if (isset($_SESSION['message'])) {
                echo "<p>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
            ?>
        <form action="./scripts/userLogin.php" method="POST">
            <input type="text" id="nom" name="nom" placeholder="Nom d'utilisateur" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Connexion">
            <div>
                <p>Pas encore inscrit ? <a href="register.php">Créer toi un compte</a></p>
            </div>
        </form>
    </div>
</body>
</html>