<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos

//variables de sesion
$name = isset($_POST['name'])? $_POST['name']:''; 
$lastname = isset($_POST['lastname'])? $_POST['lastname']:''; 
$username = isset($_POST['username'])? $_POST['username']:''; 
$password = isset($_POST['password'])? $_POST['password']:''; 
$message = '';

//ingresar datos
if ($username && $password) {
	$password =	password_hash($password, PASSWORD_BCRYPT);//enctriptar la contraseña del usuario
	$query = $conn->prepare('INSERT INTO users (name, lastname, username, password) VALUES (:name, :lastname, :username, :password)');
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
	$query->bindParam(':username', $username, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();


	// manera corta de usar bindparam
	//$query = $conn->prepare('INSERT INTO users (name, lastname, username, password) VALUES (?, ?, ?, ?)');
	//$query->execute([$name,$lastname,$username,$password]);

	//verificar datos
	if ($query === TRUE) {		
			echo  'Usuario registrado';
			header('location: /admin.php');
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
	<title>Usuarios</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" type="image/png" href="/assets/img/favicon.store2.png"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body>
	<!-- notificaciones y logout navbar.php -->
	<?php require('navigation/navbar.php')?>	
	
	<!-- navLateral.php -->
	<?php require('navigation/lateralnavbar.php')?> 

	<?php if(!empty($message)): ?>
		<p><?php echo $message ?></p>
	<?php endif; ?>

	<!-- Contenido de la página -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<img src="/assets/img/logo.store.png" alt="logo" width="250px">
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Ingresa nuevos usuarios
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabListAdmin" class="mdl-tabs__tab is-active">LISTA DE USUARIOS</a>
				<a href="#tabNewAdmin" class="mdl-tabs__tab">CREAR USUARIO</a>
			</div>
			<div class="mdl-tabs__panel" id="tabNewAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nuevo Usuario
							</div>
							<div class="full-width panel-content">
								<form action="admin.php" method="POST">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Datos de usuario</h5>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input name="name" class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="NameAdmin">
												<label class="mdl-textfield__label" for="NameAdmin">Nombre</label>
												<span class="mdl-textfield__error">Nombre inválido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input name="lastname" class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="LastNameAdmin">
												<label class="mdl-textfield__label" for="LastNameAdmin">Apellidos</label>
												<span class="mdl-textfield__error">Apellido inválido</span>
											</div>
											<!--  agregar el rol de usuario, hay que crearle su for y el id para rol
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="RolUsuario">
												<label class="mdl-textfield__label" for="LastNameAdmin">Rol de usuario</label>
												<span class="mdl-textfield__error">Rol de usuario inválido</span>
											</div> 
											-->
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Detalles de cuenta de usuario</h5>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input  name="username" class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ]*(\.[0-9]+)?" id="UserNameAdmin">
												<label class="mdl-textfield__label" for="UserNameAdmin">Nombre de usuario</label>
												<span class="mdl-textfield__error">Nombre de usuario inválido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input name="password" class="mdl-textfield__input" type="password" id="passwordAdmin">
												<label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
												<span class="mdl-textfield__error">Contraseña inválida</span>
											</div>
											<h5 class="text-condensedLight">Selecciona tu imagen de Perfil</h5>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
												<input type="radio" id="option-1" class="mdl-radio__button" name="options" value="avatar-male.png">
												<img src="assets/img/avatar-male.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 1</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
												<input type="radio" id="option-2" class="mdl-radio__button" name="options" value="avatar-female.png">
												<img src="assets/img/avatar-female.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 2</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
												<input type="radio" id="option-3" class="mdl-radio__button" name="options" value="avatar-male2.png">
												<img src="assets/img/avatar-male2.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 3</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
												<input type="radio" id="option-4" class="mdl-radio__button" name="options" value="avatar-female2.png">
												<img src="assets/img/avatar-female2.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Perfil 4</span>
											</label>
										</div>
									</div>
									<p class="text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addAdmin">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addAdmin">Crear usuario</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- ===== LISTA DE USUARIOS ===== -->
			<?php
				$querylist = 'SELECT id, name, lastname, username FROM users';
				$stm = $conn->query($querylist);
				$rows = $stm->fetchAll();
			?>
			<div class="mdl-tabs__panel is-active" id="tabListAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Lista de usuarios
							</div>
							<div class="full-width panel-content">
								<!-- ===== BUSCADOR DE USUARIOS ===== -->
								<form action="admin.php" method='GET'> 
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
										<label class="mdl-button mdl-js-button mdl-button--icon" for="searchAdmin">
											<i class="zmdi zmdi-search"></i>
										</label>
										<div class="mdl-textfield__expandable-holder">
											<input class="mdl-textfield__input" type="text" id="searchAdmin">
											<label class="mdl-textfield__label"></label>
										</div>
									</div>
								</form><!-- end form -->

								<div class="mdl-list"><!-- contenedor de la lista -->
									<?php
									if(count($rows) == 0){
										echo "No hay resultados";
									}
									?>
									<?php foreach ($rows as $row): ?>							
										<div class="mdl-list__item mdl-list__item--two-line">
											<span class="mdl-list__item-primary-content">
												<i class="zmdi zmdi-account mdl-list__item-avatar"></i>
												<span><?php echo $row['name'].' '.$row['lastname']; ?></span>
												<span class="mdl-list__item-sub-title"><?php echo $row['username']; ?></span>
											</span>
										<a href="edit_users.php"><button class="mdl-button mdl-js-button mdl-button--primary">Editar</button></a>
										<a href="delete_users.php"><button class="mdl-button mdl-js-button mdl-button--accent">Eliminar</button></a><!-- ancla -->
										</div>
										<li class="full-width divider-menu-h"></li>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>