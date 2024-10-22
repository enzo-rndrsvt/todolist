<?php
session_start();
if (isset($_SESSION['user'])) {header('Location: index.php');exit();}
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
        <h1>Inscription</h1>
        <?php
            // Afficher les erreurs si elles existent
            if (isset($_SESSION['message'])) {
                echo "<p style='color:red;'>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
            ?>
        <form action="scripts/userRegister.php" method="POST">
                <input type="text" id="nom" name="nom" placeholder="Nom d'utilisateur"required>
                <input type="password" id="password" placeholder="Mot de passe" name="password" required>
            <input type="submit" value="Inscription">
            <div>
                <p>Déjà inscrit ? <a href="login.php">Connecte toi !</a></p>
            </div>
        </form>
    </div>
</body>
</html>