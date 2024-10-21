<?php
require 'scripts/bdd.php';
$pdo = connectBDD();
$nom = 'UtilisateurTest';
$password = password_hash('mon_mot_de_passe', PASSWORD_BCRYPT);

$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:nom, :password)");
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':password', $password);
$stmt->execute();


?>