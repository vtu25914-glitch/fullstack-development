<?php
$host = "localhost";
$user = "root";
$pass = "";        // password is EMPTY
$db   = "skill_academy";
$port = 3307;      // IMPORTANT

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>