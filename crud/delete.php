<?php
include 'db/db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM users WHERE id=$id";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
} else {
    echo "Invalid request";
    exit();
}

$mysqli->close();
?>