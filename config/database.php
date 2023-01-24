<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'ibo');
define('DB_PASS', 'Levibo_1992');
define('DB_NAME', 'db');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
?>