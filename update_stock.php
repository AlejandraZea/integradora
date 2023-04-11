<?php
require_once ('conexion.php');

$id = $_POST['id'];
$stock = $_POST['stock'];

if ($stock && $id){
    $query = $conn->prepare("UPDATE products 
        SET 
        stock =:stock
        WHERE id=:id");
    $query->bindParam(':stock', $stock, PDO::PARAM_INT);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
        
    header('location: /inventory.php');
}