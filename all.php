<?php
include 'db/database.php';

// READ (Чтение записей)
$result = $conn->query("SELECT * FROM users union select * from user2 union select * from users_auth Order by id");


if ($result->num_rows > 0) {
    echo "<h2>Users ALL</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['full_name']}</td><td>{$row['email']}</td><td>{$row['age']}</td>";
        echo "<td><a href='update_all.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

<a href="all.php">All Users</a>
<a href="auth.php">Auth Users</a>
<a href="index.php">Users Table</a>
<a href="export.php">EXPORT FROM EXCEL</a>
