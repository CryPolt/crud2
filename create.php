<?php
include 'db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO users (name, email, age) VALUES ('$name' , '$email' , $age)";

    if ($mysqli->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>

<h2>Add User</h2>
<form method="post" action="create.php">
    <label for="name">Full Name:</label>
    <input type="text" name="name" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="age">Age:</label>
    <input type="number" name="age" required>
    <input type="submit" name="create" value="Add User">
</form>