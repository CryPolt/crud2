<?php
include 'db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $mysqli->query("SELECT * FROM users_auth WHERE username='$username'");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Login successful. Welcome, $username!";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

$mysqli->close();
?>

<h2>Login</h2>
<form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <input type="submit" name="login" value="Login">
</form>