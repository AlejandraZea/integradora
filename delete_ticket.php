<?php
require_once ('conexion.php');

$id = $_GET['id'];

if($id > 0){
    $query = $conn->prepare("DELETE FROM tickets WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    echo  'Ticket eliminado';
}
header('location: /sales.php');