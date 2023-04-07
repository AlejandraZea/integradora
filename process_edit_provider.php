<?php
require_once ('conexion.php');

$id = $_POST['id'];
$name = $_POST['name']; 
$address = $_POST['address']; 
$phone = $_POST['phone']; 
$email = $_POST['email'];

if ($name) {
	$query = $conn->prepare("UPDATE providers 
        SET 
            name=:name, 
            address=:address,  
            phone=:phone, 
            email=:email 
        WHERE id=:id");
        
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':address', $address, PDO::PARAM_STR);
	$query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();

    echo  'Usuario actualizado';
    header('location: /providers.php');
}