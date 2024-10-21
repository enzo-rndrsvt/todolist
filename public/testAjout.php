<?php
require 'scripts/bdd.php';
$pdo = connectBDD();
$nom = 'test';
$password = password_hash('test', PASSWORD_BCRYPT);

$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:nom, :password)");
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':password', $password);
$stmt->execute();

header('Location: ../login.php');
exit();

?>