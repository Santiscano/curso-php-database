<?php 

$server = "localhost";
$database = "test";
$username = "santiscano";
$password = "santiscano";


// forma procedural
$connProc = mysqli_connect($server, $username, $password, $database);
if (!$connProc) {
    die("Connection failed: " . mysqli_connect_error());
}

// forma orientada a objetos
$connObj = new mysqli($server, $username, $password, $database);
if ($connObj->connect_errno) {
    die("Connection failed: " . $connObj->connect_error);
}

echo "Connected successfully";
