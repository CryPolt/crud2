<?php

namespace create;
require_once '../db/db.php';
use DB\db;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO users (name, email, age) VALUES ('$name' , '$email' , $age)";
    $sqlhistory = "insert into users_history (name, email, age) VALUES ('$name' , '$email' , $age)";


    if ($db->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error();
    }
    if ($db->query($sqlhistory) === TRUE) {
        echo "New record History successfully";
    } else {
        echo "Error: " . $sqlhistory . "<br>" . $db->error();
    }
}
    $db->close();

echo'
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/create.css">
    <title>create</title>
</head>
<body>

<div class="registration-form">
    <form method="post" action="create.php">
        <h3 class="text-center">Create your account</h3>
        <div class="form-group">
            <input class="form-control item" type="text" name="name" maxlength="15" minlength="4" pattern="^[a-zA-Z0-9_.-]*$" id="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input class="form-control item" type="email" name="email" minlength="6" id="email" placeholder="email" required>
        </div>
        <div class="form-group">
            <input class="form-control item" type="number" name="age" id="age" placeholder="age" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block create-account" name="create" type="submit">Create Account</button>
        </div>
    </form>
</div>


</body>
</html>
';



