

<?php
// Vérifier si l'utilisateur est connecté
require 'scripts/bdd.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectBDD();

if (isset($_SESSION['user'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :id');
    $stmt->execute(['id' => $_SESSION['user']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE user_id = :id');
    $stmt->execute(['id' => $_SESSION['user']]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<p>Bonjour ' . htmlspecialchars($user['username']) . '.</p>';
    echo '<a href="logout.php"><button>Logout</button></a>';
    
    

} else {
    echo '<p>Vous n\'êtes pas connecté.</p>';
    echo '<a href="login.php"><button>Login</button></a>';
}

?>
<link rel="stylesheet" href="./styles/index.css"><body>
    <h2>Ajouter une tâche</h2>
    <form action="scripts/addTasks.php" method="POST">
        <label for="nom a">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <label for="description">Description :</label>
        <input type="text" id="description" name="description" required>
        <input type="submit" value="Ajouter la tâche">
    </form>

    <h2>Tâches en cours</h2>
    <?php
    foreach ($tasks as $task) {
        if (!$task['is_completed']) {
            echo '<li><div><p>' . htmlspecialchars($task['task_name']) . '</p><p>' . htmlspecialchars($task['task_description']) . '</p></div></li>';
            echo '<form action = scripts/completeTask.php method="POST"> <input type="hidden" name="task_id" value="' . $task['task_id'] . '"> <button type="submit">Compléter</button> </form> </form>';
            echo '</li>';
        }
    }
    ?>

    <h2>Tâches terminées</h2>
    <?php
    foreach ($tasks as $task) {
        if ($task['is_completed']) {
            echo '<li>' . htmlspecialchars($task['task_description']) . '</li>';
        }
    }
    ?>
</body>
