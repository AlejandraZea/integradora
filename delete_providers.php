<?php
require_once ('conexion.php');

$id = $_GET['id'];

if($id > 0){
    $query = $conn->prepare("DELETE FROM providers WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    echo  'Usuario actualizado';
}
header('location: /providers.php');