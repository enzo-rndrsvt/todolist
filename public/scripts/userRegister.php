<?php
session_start();
require 'bdd.php';

if(!isset($_POST['nom']) || !isset($_POST['password']) || !isset($_POST['email'])){ 
    header('Location: ../register.php');
    exit();
}

$pdo = connectBDD();

$nom = htmlspecialchars($_POST['nom']);
$email = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Vérifier si le nom d'utilisateur existe déjà
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :nom");
$stmt->bindParam(':nom', $nom);
$stmt->execute();
$userExists = $stmt->fetchColumn();

// Vérifier si l'email existe déjà
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$emailExists = $stmt->fetchColumn();

if($userExists > 0){
    $_SESSION['error'] = "Nom d'utilisateur déjà pris.";
    header('Location: ../register.php');
    exit();
}

if($emailExists > 0){
    $_SESSION['error'] = "Adresse mail déjà utilisée.";
    header('Location: ../register.php');
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:nom, :email, :password)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $_SESSION['message'] = "Compte créé avec succès, veuillez maintenant vous connecter.";
    header('Location: ../login.php');
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header('Location: ../register.php');
}
exit();


?>