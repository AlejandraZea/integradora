<?php
$usuarios = array(
    "usuario1" => "contraseña1",
    "usuario2" => "contraseña2",
    "usuario3" => "contraseña3"
);

if(isset($_POST['username']) && isset($_POST['password'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if(isset($usuarios[$userName]) && $usuarios[$userName] == $password) {
        // Inicio de sesión correcto, redirigir al usuario a la página de inicio
        header("Location: index.html");
        exit();
    } else {
        // Inicio de sesión incorrecto, mostrar mensaje de error
        echo "Nombre de usuario o contraseña incorrectos";
    }
}
?>