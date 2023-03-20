<?php

// ========= Configuracion a base de datos =========
$servername = "localhost";
$database = "store";
$username = "root";
$password = "";

// ========= Crear conexión ========= 
try{
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}
// echo "Connection successfully";