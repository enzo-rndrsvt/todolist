

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <h2>Ajouter une tâche</h2>
    <form action="scripts/addTasks.php" method="POST">
        <div class="container">
            <div>
                <input type="text" id="nom" name="nom" placeholder="Nom de la tâche" required>
                <input type="text" id="description" name="description" placeholder="Description de la tâche" required>
            </div>
                <input type="submit" value="Ajouter la tâche">
        </div>
    </form>

    <h2>Tâches en cours</h2>
    <?php
    foreach ($tasks as $task) {
        if (!$task['is_completed']) {
            echo '<div class="task">';
            echo '<p>' . htmlspecialchars($task['task_name']) . '</p><p>' . htmlspecialchars($task['task_description']) . '</p>';
            echo '<form action = scripts/completeTask.php method="POST"> <input type="hidden" name="task_id" value="' . $task['task_id'] . '"> <button type="submit" class="complete"><i class="fa-solid fa-check"></i></button> </form> </form>';
            echo '<form action = scripts/deleteTask.php method="POST"> <input type="hidden" name="task_id" value="' . $task['task_id'] . '"> <button type="submit" class="delete"><i class="fa-solid fa-trash"></i></button> </form> </form>';
            echo '</div>';
        }
    }
    ?>

    <h2>Tâches terminées</h2>
    <?php
    foreach ($tasks as $task) {
        if ($task['is_completed']) {
            echo '<div class="task">';
            echo '<p>' . htmlspecialchars($task['task_name']) . '</p><p>' . htmlspecialchars($task['task_description']) . '</p>';
            echo '<form action = scripts/deleteTask.php method="POST"> <input type="hidden" name="task_id" value="' . $task['task_id'] . '"> <button type="submit" class="delete"><i class="fa-solid fa-trash"></i></button> </form> </form>';
            echo '</div>';
        }
    }
    ?>
</body>
