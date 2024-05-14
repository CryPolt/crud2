<?php
// Сохраняем данные конфигурации в переменную
$config = require_once '../db/db.php';
// Подключаем нотификации
require_once '../notification.php';
// Инициализируем сессию
session_start();

// Если это POST-запрос, то есть мы нажали на кнопку "Регистрация", выполняем процесс регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // В этот массив будем собирать возможные ошибки
    $errors = [];

    // Валидируем email
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    if (empty($email)) {
        $errors[] = 'Введите email';
    }
    if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
        $errors[] = 'Неверный email';
    }

    // Валидируем пароль
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    if (empty($password)) {
        $errors[] = 'Введите пароль';
    }
    if (strlen(trim($password)) < 6 || strlen(trim($password)) > 50) {
        $errors[] = 'Пароль должен содержать не менее 6 и не более 50 символов';
    }

    // Проверяем, правильно ли пользователь подтвердил пароль
    $passwordRepeat = isset($_POST['password_repeat']) ? trim($_POST['password_repeat']) : null;
    if ($password !== $passwordRepeat) {
        $errors[] = 'Пароль подвержден неверно';
    }

    // Если ошибок нет, продолжаем
    if (empty($errors)) {
        try {
            // Подключаемся к базе данных

            // Делаем запрос в базу, проверяя, существует ли уже зарегистрированный пользователь с таким email
            $sql = "SELECT id FROM users_auth WHERE email = '$email'";
            $result = $db->query($sql);
            // Если такой пользователь есть, выводим сообщение
            if ($result->fetch_assoc()) {
                notify('Пользователь с таким email уже существует');
            } else { // Иначе создаем запись в базе данных с новым пользователем
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users_auth (email, password) VALUES ('$email', '$passwordHash')";
                $db->query($sql);

                // После создания нового пользователя редиректим на страницу авторизации
                header('location: login.php');
                exit;
            }
        } catch (mysqli_sql_exception $e) {
            // Если произошла какая-либо ошибка при регистрации, выводим ее
            notify('Произошла ошибка при регистрации');
            // Можно сделать запись в лог об ошибке
            error_log($e->__toString());
        } finally { // При любом исходе процесса регистрации закрываем подключение к базе данных
            if (isset($db)) {
                $db->close();
            }
        }
    } else { // В случае наличия ошибок выводим их на страницу
        notify(implode('<br>', $errors));
    }
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

<section class="container w-25">
    <h2>Регистрация</h2>
    <form method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password-repeat">Повторите пароль</label>
            <input type="password" name="password_repeat" class="form-control" id="password-repeat"
                   placeholder="Repeat password">
        </div>
        <button type="submit" class="btn btn-primary">Регистрация</button>
    </form>

    <?php notify(); ?>
</section>

</body>
</html>