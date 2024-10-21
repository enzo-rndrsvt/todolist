<?php
session_start();
if (isset($_SESSION['user'])) {header('Location: index.php'); exit();}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./styles/auth.css"><body>
</head>
<body>
<body>
    <div class="container">
        <p>Connectez vous pour utliser le service</p>
        <?php
            if (isset($_SESSION['message'])) {
                echo "<p>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
            ?>
        <form action="./scripts/userLogin.php" method="POST">
            <div>
                <label for="nom">Nom d'utilisateur</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Connexion">
            <div>
                <p>Pas encore inscrit ?<a href="register.php">Créer toi un compte</a></p>
            </div>
        </form>
    </div>
</body>
</html>