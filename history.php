<?php

require_once './db/db.php';

// READ (Чтение записей)
$result = $db->query("SELECT * FROM users_history Order by id");


if ($result->num_rows > 0) {
    echo "<h2>Users History</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['age']}</td>";
        echo "<td><a href='crud/update.php?id={$row['id']}'>Edit</a> | <a href='crud/delete.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<br>" .$db->connected();
}

$db->close();
?>

<a href="all.php">All Users</a>
<a href="crud/index.php">Users Table</a>
<a href="export/exportusershistory.php">EXPORT FROM EXCEL</a>
