<?php
session_start();//iniciar la sesion
session_destroy();//salir de la sesion actual
header('location: /index.php');  //redireccion
