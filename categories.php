<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos

//variables de sesion
$name = isset($_POST['name'])? $_POST['name']:''; 
$description = isset($_POST['description'])? $_POST['description']:'';
$message = '';

//Insertar datos
if ($name && $description) {
	$query = $conn->prepare('INSERT INTO categories (name, description) VALUES (:name, :description)');
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':description', $description, PDO::PARAM_STR);
	$query->execute();

	//verificar datos
	if ($query === TRUE) {		
			echo  'Categoria registrada';
			header('location: /categories.php');
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
	<title>CATEGORIAS</title>
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
				<i class="zmdi zmdi-label"></i>
			</div>
			<div class="full-width header-well-text">
			<h3 class="text-left tittles">CATEGORIAS</h3>
	
				<p class="text-condensedLight"><br/>
					Ingresa las categorías
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabListCategory" class="mdl-tabs__tab is-active">LISTA DE CATEGORIAS</a>
				<a href="#tabNewCategory" class="mdl-tabs__tab">CREAR NUEVA CATEGORIA</a>
			</div>
			<!-- === crear nuevas categorias === -->
			<div class="mdl-tabs__panel" id="tabNewCategory">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nueva categoría
							</div>
							<div class="full-width panel-content">
								<!-- formulario -->
								<form action='categories.php' method='POST'>
									<h5 class="text-condensedLight">Información de categoría</h5>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input type="text" name='name' class="mdl-textfield__input" pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="NameCategory">
										<label class="mdl-textfield__label" for="NameCategory">Nombre</label>
										<span class="mdl-textfield__error">Nombre inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input type="text" name='description' class="mdl-textfield__input" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="descriptionCategory">
										<label class="mdl-textfield__label" for="descriptionCategory">Descripción breve</label>
										<span class="mdl-textfield__error">Descripción inválido</span>
									</div>
									<p class="text-center">
										<button type='submit' class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addCategory">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addCategory">Añadir categoría</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div><!-- end creacion de categorías -->

			<!-- === Lista de categorias === -->
			<?php
				$querylist = 'SELECT id, name, description FROM categories';
				$stm = $conn->query($querylist);
				$rows = $stm->fetchAll();
			?>
			<div class="mdl-tabs__panel is-active" id="tabListCategory">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Lista de categorías
							</div>
							<div class="full-width panel-content">
								<form action="categories.php"><!-- ===== BUSCADOR DE CATEGORIAS ===== -->
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
										<label class="mdl-button mdl-js-button mdl-button--icon" for="searchCategory">
											<i class="zmdi zmdi-search"></i>
										</label>
										<div class="mdl-textfield__expandable-holder">
											<input class="mdl-textfield__input" type="text" id="searchCategory">
											<label class="mdl-textfield__label"></label>
										</div>
									</div>
								</form> <!-- end form -->

								<div class="mdl-list"> <!-- contenedor de la lista -->
									<?php 
										if(count($rows) == 0) {
											echo "No hay resultados";
										}
										?>
									<?php foreach($rows as $row): ?>
									<div class="mdl-list__item mdl-list__item--two-line">
										<span class="mdl-list__item-primary-content">
											<i class="zmdi zmdi-label mdl-list__item-avatar"></i>
											<span><?php echo $row['name'];?></span>
											<span class="mdl-list__item-sub-title"><?php echo $row['description']; ?></span>
										</span>
										<a href="edit_categories-php"><button class="mdl-button mdl-js-button mdl-button--primary">Editar</button></a>
										<a href="delete_categories.php"><button class="mdl-button mdl-js-button mdl-button--accent">Eliminar</button></a>
									</div>
									<li class="full-width divider-menu-h"></li>
									<?php endforeach; ?>
								</div><!-- end lista de categorias  -->
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>