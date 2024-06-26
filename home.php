<?php

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>home page</title>

</head>
<body>


    <div class="form-group">
    <a href="crud/index.php" class ="btn">User Table</a>
    <a href="history.php" class = "btn">User History</a>
    <a href="all.php" class = "btn">User ALL Table</a>  
    </div>

    <div class="form-group">
        <div class="row">
            <div class="raw"><a href="crud/create.php">User create</a></div>
        </div>
    </div>
  
</body>
</html>';

include 'db/db.php';

// READ (Чтение записей)
$result = $db->query("SELECT * FROM users Order by id");


if ($result->num_rows > 0) {
    echo "<h2>Users ALL</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['age']}</td>";
    }

    echo "</table>";
} else {
    echo "<br>" .$db->connected();
}
echo '<br>';

// READ (Чтение записей)
$result = $db->query("SELECT * FROM users_history Order by id");


if ($result->num_rows > 0) {
    echo "<h2>Users history (all)</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['age']}</td>";
    }

    echo "</table>";
} else {

    echo "0 results" ."<br>" .$db->connected();

}

;

$db->close();
?>