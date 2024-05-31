<?php 

$server = "localhost";
$database = "test";
$username = "santiscano";
$password = "santiscano";

try {
    $connPdo = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $connPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

echo "Connected successfully";
