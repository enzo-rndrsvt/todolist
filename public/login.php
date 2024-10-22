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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <div><input type="text" id="nom" name="nom" placeholder="Nom d'utilisateur" required></div>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>
            <div><input type="submit" value="Connexion"></div>
            <div>
                <p>Pas encore inscrit ? <a href="register.php">Créer toi un compte</a></p>
            </div>
        </form>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>