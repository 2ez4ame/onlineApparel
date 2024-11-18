<?php
// databaseconnection.php

// Create a connection to the MySQL database using MySQLi
$conn = new mysqli('localhost', 'root', '', 'apparel');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
