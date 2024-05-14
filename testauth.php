<?php
// Инициализируем сессию
session_start();

// Функция проверки, авторизован ли пользователь
function isLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'];
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Homepage</title>
</head>
<body>
<article class="container">
    <h1>Homepage</h1>

    <!-- Отображаем различные кнопки, в зависимости от того, авторизован ли пользователь -->
    <?php if (isLoggedIn()) { ?>
        <a href="./auth/logout.php" class="btn btn-secondary">Выйти</a>
    <?php } else { ?>
        <a href="./auth/register.php" class="btn btn-primary">Регистрация</a>
        <a href="./auth/login.php" class="btn btn-primary">Авторизация</a>
    <?php }  ?>
</article>
</body>
</html>

<?php

require_once './db/db.php';

// READ (Чтение записей)
$result = $db->query("SELECT * FROM users_auth Order by id");


if ($result->num_rows > 0) {
    echo "<h2>Users register</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['password']}</td>";
        echo "<td><a href='crud/update.php?id={$row['id']}'>Edit</a> | <a href='crud/delete.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<br>" .$db->connected();
}

$db->close();
?>
