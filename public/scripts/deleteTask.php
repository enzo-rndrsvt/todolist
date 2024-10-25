<?php
session_start();
require 'bdd.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $pdo = connectBDD();
    $requete = $pdo->prepare("DELETE FROM tasks WHERE task_id = :task_id");
    $requete->execute(['task_id' => $_POST['task_id']]);

    header('Location: ../index.php');
    exit;
}

?>