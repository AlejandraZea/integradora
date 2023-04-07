<?php
session_start();
require_once ('conexion.php'); 

$id = $_GET['id'];

$query = $conn->query('SELECT * FROM categories WHERE id = ' . $id.' LIMIT 1');
$row = $query->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EDITAR CATEGORIAS</title>
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
			<h3 class="text-left tittles">EDITAR CATEGORIAS</h3>
	
				<p class="text-condensedLight"><br/>
					Actualizar categoria
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewCategory" class="mdl-tabs__tab is-active">CREAR NUEVA CATEGORIA</a>
			</div>
			<!-- === crear nuevas categorias === -->
			<div class="mdl-tabs__panel is-active" id="tabNewCategory">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Editar categoría
							</div>
							<div class="full-width panel-content">
								<!-- formulario -->
								<form action="process_edit_categories.php" method="POST">
									<h5 class="text-condensedLight">Información de categoría</h5>
                                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="name"
                                        type="text"  
                                        class="mdl-textfield__input" 
                                        pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" 
                                        id="NameCategory"
                                        value="<?php echo $row["name"]; ?>" />
										<label class="mdl-textfield__label" for="NameCategory">Nombre</label>
										<span class="mdl-textfield__error">Nombre inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input name="description"
                                        type="text"  
                                        class="mdl-textfield__input" 
                                        pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" 
                                        id="descriptionCategory"
                                        value="<?php echo $row["description"]; ?>" />
										<label class="mdl-textfield__label" for="descriptionCategory">Descripción breve</label>
										<span class="mdl-textfield__error">Descripción inválido</span>
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
			</div><!-- end creacion de categorías -->
		</div>
	</section>
</body>
</html>