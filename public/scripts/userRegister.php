<?php
session_start();
require 'bdd.php';

if(!isset($_POST['nom']) || !isset($_POST['password'])){
    header('Location: ../register.php');
    exit();
}

$pdo = connectBDD();

$nom = htmlspecialchars($_POST['nom']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Vérifier si le nom d'utilisateur existe déjà
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :nom");
$stmt->bindParam(':nom', $nom);
$stmt->execute();
$userExists = $stmt->fetchColumn();

if($userExists > 0){
    $_SESSION['message'] = "Nom d'utilisateur déjà pris.";
    header('Location: ../register.php');
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:nom, :password)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $_SESSION['message'] = "Compte créé avec succès, veuillez maintenant vous connecter.";
    header('Location: ../login.php');
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header('Location: ../register.php');
}
exit();
?>