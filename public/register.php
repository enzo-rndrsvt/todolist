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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red;'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['message'])) {
                echo "<p>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
            ?>
        <form action="scripts/userRegister.php" method="POST">
            <div><input type="text" id="nom" name="nom" placeholder="Nom d'utilisateur"required></div>
            <div><input type="email" id="email" name="email" placeholder="Adresse mail" required></div>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>
            <div><input type="submit" value="Inscription"></div>
            <div>
                <p>Déjà inscrit ? <a href="login.php">Connecte toi !</a></p>
            </div>
        </form>
    </div>
</body>
</html>