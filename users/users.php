<?php
        include 'conexion.php'; // para hacer la conexion con la pagina conexion.php
        // echo "<br/>";

        // sentencia para mandar a llamar la tabla de usuarios con su informacion
        $sql = "SELECT id, name, lastname, username, password from users";
        $result = $conn->query($sql);    

?> 