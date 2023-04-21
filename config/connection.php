<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'fesdb';

try {
    // Create database connection
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
