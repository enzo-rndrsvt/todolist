<?php
function connectBDD(){
    $host = 'localhost';
    $dbname = 'todolist';
    $username = 'root';
    $password = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
        echo "Erreur : " . $e->getMessage();
        die();
    }
};
//test
?>