<?php
$HostName="localhost";
$UserName="root";
$Password="";
$DataBase="dating_app";

// Create a connection
try {
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
