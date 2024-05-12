<?php
include 'db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO users_auth (full_name, email, age) VALUES ('$full_name','$email', '$age')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Registration successful. You can now <a href='login.php'>login</a>.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}


$mysqli->close();
?>

<h2>Registration</h2>
<form method="post" action="register.php">
    <label for="email">Email:</label>
    <input type="text" name="email" required>
    <label for="full_name">full_name:</label>
    <input type="text" name="username" required>
    <label for="age">age:</label>
    <input type="text" name="age" required>
    <input type="submit" name="register" value="Register">
</form>

