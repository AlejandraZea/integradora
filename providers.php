<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos

//variables de sesion
$name = isset($_POST['name'])? $_POST['name']:''; 
$address = isset($_POST['address'])? $_POST['address']:''; 
$phone = isset($_POST['phone'])? $_POST['phone']:''; 
$email = isset($_POST['email'])? $_POST['email']:''; 
$message = '';

//ingresar datos
if ($name && $address) {
	$query = $conn->prepare('INSERT INTO providers (name, address, phone, email) VALUES (:name, :address, :phone, :email)');
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':address', $address, PDO::PARAM_STR);
	$query->bindParam(':phone', $phone, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();

	//verificar datos
	if ($query === TRUE) {		
			echo  'Proveedor registrado';
			header('location: /providers.php');
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
	<title>PROVEEDORES</title>
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
	
	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<img src="/assets/img/logo.store.png" alt="logo" width="250px">
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Ingresa los datos de tus proveedores
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabListProvider" class="mdl-tabs__tab is-active">LISTA DE PROVEEDORES</a>
				<a href="#tabNewProvider" class="mdl-tabs__tab">NUEVO PROVEEDOR</a>				
			</div>
			<div class="mdl-tabs__panel" id="tabNewProvider">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nuevo proveedor
							</div>
							<div class="full-width panel-content">
								<!-- ====== formulario ====== -->
								<form action='providers.php' method='POST'>
									<h5 class="text-condensedLight">Información de Proveedores</h5>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="name" class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9 ]*(\.[0-9]+)?" id="NameProvider">
										<label class="mdl-textfield__label" for="NameProvider">Nombre</label>
										<span class="mdl-textfield__error">Nombre inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="address" class="mdl-textfield__input" type="text" id="addressProvider">
										<label class="mdl-textfield__label" for="addressProvider">Dirección</label>
										<span class="mdl-textfield__error">Dirección inválida</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="phone" class="mdl-textfield__input" type="tel" pattern="-?[0-9+()- ]*(\.[0-9]+)?" id="phoneProvider">
										<label class="mdl-textfield__label" for="phoneProvider">Teléfono</label>
										<span class="mdl-textfield__error">Teléfono inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="email" class="mdl-textfield__input" type="email" id="emailProvider">
										<label class="mdl-textfield__label" for="emailProvider">E-mail</label>
										<span class="mdl-textfield__error">E-mail Inválido</span>
									</div>
									<p class="text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addProvider">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addProvider">Ingresar Proveedor</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- === listado de proveedores === -->
			<?php
				$querylist = 'SELECT id, name, phone, email from providers';
				$stm = $conn->query($querylist);
				$rows = $stm->fetchAll();
			?>
			<div class="mdl-tabs__panel is-active" id="tabListProvider">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								LISTA DE PROVEEDORES
							</div>
							<div class="full-width panel-content">
								<form action="#">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
										<label class="mdl-button mdl-js-button mdl-button--icon" for="searchProvider">
											<i class="zmdi zmdi-search"></i>
										</label>
										<div class="mdl-textfield__expandable-holder">
											<input class="mdl-textfield__input" type="text" id="searchProvider">
											<label class="mdl-textfield__label"></label>
										</div>
									</div>
								</form><!-- termina formulario -->

								<div class="mdl-list"><!-- contenedor de la lista -->
								<?php
									if(count($rows) == 0){
										echo "No hay resultado";
									}
								?>
								<?php foreach($rows as $row): ?>
									<div class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content">
											<i class="zmdi zmdi-truck mdl-list__item-avatar"></i>
											<span type="hidden" name="id" value="<?php echo $row["id"]; ?>"></span>
											<span><?php echo $row['name']; ?></span>
											<span class="mdl-list__item-sub-title"><?php echo $row['phone']; ?></span>
										</span>
										
										<a href="edit_providers.php?id=<?php echo $row['id']; ?>"><button class="mdl-button mdl-js-button mdl-button--primary">Editar</button></a>
										<a href="delete_providers.php?id=<?php echo $row['id']; ?>"><button class="mdl-button mdl-js-button mdl-button--accent">Eliminar</button></a>
										
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