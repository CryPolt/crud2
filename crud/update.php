<?php


require_once '../db/db.php';
use DB\db;
// Проверяем, был ли запрос отправлен методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["full_name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "UPDATE users SET name='$name', email='$email', age=$age WHERE id=$id";

    if ($db->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $db->error();
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqld = "SELECT * FROM users WHERE id=$id";
    $result = $db->query($sqld);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $email = $row["email"];
        $age = $row["age"];
        echo "
        <h2>Edit User</h2>
        <form method='post' action='update.php'>
            <input type='hidden' name='id' value='$id'>
            <label for='full_name'>Full Name:</label>
            <input type='text' name='full_name' value='$name' required>
            <label for='email'>Email:</label>
            <input type='email' name='email' value='$email' required>
            <label for='age'>Age:</label>
            <input type='number' name='age' value='$age' required>
            <input type='submit' name='update' value='Update User'>
        </form>
        ";
    }
}

// Закрываем соединение через объект $db
$db->close();

?>
