<?php
require 'scripts/bdd.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $pdo = connectBDD();
    $nom = htmlspecialchars($_POST['nom']);
    $requete = $pdo->prepare("DELETE t FROM tasks t JOIN users u ON t.user_id = u.user_id WHERE u.username = :nom");
    $requete->bindParam(':nom', $nom);
    $requete->execute();

    $_SESSION['message'] = "Liste des tâches supprimé pour l'utilisateur : $nom";

    header('Location: admin.php');
    exit;
}

echo '<h2>Liste des utilisateurs</h2>';
$pdo = connectBDD();
$stmt = $pdo->prepare('SELECT * FROM users');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($users as $user){
    echo $user['username'] . ' | ' . $user['email'] . '</br>';
}
?>




<body>
    <form action="" method="POST">
        <div>
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }
            ?>
            <label for="nom">Compte : </label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <input type="submit" value="Supprimer">
    </form>
</body>