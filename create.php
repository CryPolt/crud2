<?php
include 'db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO users (full_name, email, age) VALUES ('$full_name', '$email', $age)";

    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<h2>Add User</h2>
<form method="post" action="create.php">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="age">Age:</label>
    <input type="number" name="age" required>
    <input type="submit" name="create" value="Add User">
</form>