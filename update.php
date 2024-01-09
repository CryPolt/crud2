<?php
include 'db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "UPDATE users SET full_name='$full_name', email='$email', age=$age WHERE id=$id";
    

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $full_name = $row["full_name"];
        $email = $row["email"];
        $age = $row["age"];
        echo "
        <h2>Edit User</h2>
        <form method='post' action='update.php'>
            <input type='hidden' name='id' value='$id'>
            <label for='full_name'>Full Name:</label>
            <input type='text' name='full_name' value='$full_name' required>
            <label for='email'>Email:</label>
            <input type='email' name='email' value='$email' required>
            <label for='age'>Age:</label>
            <input type='number' name='age' value='$age' required>
            <input type='submit' name='update' value='Update User'>
        </form>
        ";
    }
}

$conn->close();
?>