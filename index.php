<a href="login.php">Login</a>
<a href="register.php">Register</a>
<?php
include 'db/db.php';

// READ (Чтение записей)
$result = $mysqli->query("SELECT * FROM users");


if ($result->num_rows > 0) {
    echo "<h2>Users</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['age']}</td>";
        echo "<td><a href='update.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$mysqli->close();
?>

<a href="auth.php">Auth Users</a>
<a href="all.php">All Users</a>
<a href="create.php">Add User</a>
<a href="exportusers.php">EXPORT USERS TABLE</a>