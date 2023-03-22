<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos

//variables de sesion
$username = isset($_POST['username'])? $_POST['username']:''; 
$password = isset($_POST['pass'])? $_POST['pass']:''; 
$message = '';
//si contiene usuario y contraseña 
if ($username && $password) {
	$records = $conn->prepare('SELECT id, name, lastname, username, password FROM users where username=:username LIMIT 1');
	$records->bindParam(':username', $username);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	//verificar el password
	if ($results && password_verify($password, $results['password'])) {
		$_SESSION['id'] = $results['id'];
		$_SESSION['user'] = [
			'id' => $results['id'],
			'name' => $results['name'],
			'lastname' => $results['lastname'],
			'username' => $results['username']
		];
		//mensaje
		$message = 'Successfully logged';
		header('location: /home.php');
	} else {
		$message = 'Los datos ingresados no son correctos';
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/sweetalert2.css">
	<link rel="stylesheet" href="/css/material.min.css">
	<link rel="stylesheet" href="/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="icon" type="image/png" href="/assets/img/favicon.store3.png"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="/js/material.min.js" ></script>
	<script src="/js/sweetalert2.min.js" ></script>
	<script src="/js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="/js/main.js" ></script>
</head>

<body class="cover">
	<div class="container-login">
		<p class="text-center" style="font-size: 80px;">
			<i class="zmdi zmdi-account-circle"></i>
		</p>
		<p class="text-center text-condensedLight">Ingresa con tu cuenta</p>


	<?php if(!empty($message)): ?>
		<p><?php echo $message ?></p>
	<?php endif; ?>

		<form action="index.php" method="post">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input type="text" name="username" class="mdl-textfield__input" />
			    <label class="mdl-textfield__label" for="username">Usuario</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input type="password" name="pass" class="mdl-textfield__input" />
			    <label class="mdl-textfield__label" for="pass">Contraseña</label>
			</div>
			<button type="submit" id="SingIn" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="color: #3F51B5; float:right;">
				Iniciar Sesión <i class="zmdi zmdi-mail-send"></i>
			</button>
		</form>
	</div>
</body>
</html>