<?php
require_once ('conexion.php');

$name = $_POST['name']; 
$description = $_POST['description']; 
$id = $_POST['id'];

if ($name || $description) {
	$query = $conn->prepare("UPDATE categories 
        SET 
            name=:name, 
            description=:description
        WHERE id=:id");
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();

    echo  'Usuario actualizado';
    header('location: /categories.php');
}