<?php

$host = "localhost";
$user = 'crypolt';
$password = 'root';
$database = 'crudphp';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
}
