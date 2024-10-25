<?php
session_start();
require 'bdd.php';
$pdo = connectBDD();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);

    $requete = $pdo->prepare("INSERT INTO tasks (user_id, task_name, task_description, is_completed) VALUES (:user_id, :task_name, :task_description, FALSE)");
    $requete->execute(['user_id' => $_SESSION['user'],'task_name' => $name, 'task_description' => $description]);

    header('Location: ../index.php');
    exit;
}


?>

