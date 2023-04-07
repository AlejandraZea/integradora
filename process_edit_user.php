<?php
require_once ('conexion.php');

$name = $_POST['name']; 
$lastname = $_POST['lastname']; 
$username = $_POST['username']; 
$password = $_POST['password'] ?? ''; 
$avatar = $_POST['avatar']; 
$role_id = $_POST['role_id'];
$id = $_POST['id'];

if ($username) {
	$query = $conn->prepare("UPDATE users 
        SET 
            name=:name, 
            lastname=:lastname, 
            username=:username, 
            role_id=:role_id, 
            avatar=:avatar
        WHERE id=:id");
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
	$query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':role_id', $role_id, PDO::PARAM_INT);
	$query->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();

    if ($password != ''){
        $password =	password_hash($password, PASSWORD_BCRYPT);//enctriptar la contraseña del usuario
        $query = $conn->prepare("UPDATE users SET password=:password WHERE id=:id");
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    echo  'Usuario actualizado';
    header('location: /admin.php');
}