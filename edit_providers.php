<?php
session_start();
require_once ('conexion.php'); 

$id = $_GET['id'];

$query = $conn->query('SELECT * FROM providers WHERE id = ' . $id.' LIMIT 1');
$row = $query->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ACTUALIZAR PROVEEDORES</title>
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
					Editar proveedor
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewProvider" class="mdl-tabs__tab is-active">EDITAR PROVEEDOR</a>				
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewProvider">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Editar proveedor
							</div>
							<div class="full-width panel-content">
								<!-- ====== formulario ====== -->
								<form action='process_edit_provider.php' method='POST'>
									<h5 class="text-condensedLight">Información de Proveedores</h5>
                                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="name" 
                                        class="mdl-textfield__input" 
                                        type="text" 
                                        pattern="-?[A-Za-z0-9 ]*(\.[0-9]+)?" 
                                        id="NameProvider"
                                        value="<?php echo $row["name"]; ?>">
										<label class="mdl-textfield__label" for="NameProvider">Nombre</label>
										<span class="mdl-textfield__error">Nombre inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="address" 
                                        class="mdl-textfield__input" 
                                        type="text" 
                                        id="addressProvider"
                                        value="<?php echo $row["address"]; ?>"/>
										<label class="mdl-textfield__label" for="addressProvider">Dirección</label>
										<span class="mdl-textfield__error">Dirección inválida</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="phone" 
                                        class="mdl-textfield__input" 
                                        type="tel" 
                                        pattern="-?[0-9+()- ]*(\.[0-9]+)?" 
                                        id="phoneProvider"
                                        value="<?php echo $row["phone"]; ?>"/>
										<label class="mdl-textfield__label" for="phoneProvider">Teléfono</label>
										<span class="mdl-textfield__error">Teléfono inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="email" 
                                        class="mdl-textfield__input" 
                                        type="email" 
                                        id="emailProvider"
                                        value="<?php echo $row["email"]; ?>" />
										<label class="mdl-textfield__label" for="emailProvider">E-mail</label>
										<span class="mdl-textfield__error">E-mail Inválido</span>
									</div>
									<p class="text-center">
                                    <button type="submit" value="edit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                          Actualizar
                                    </button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>