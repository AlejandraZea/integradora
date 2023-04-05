<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos

//variables de sesion
$barcode = $_POST['barcode'] ?? ''; 
$name = $_POST['name'] ?? '';
$stock = $_POST['stock'] ?? ''; 
$price = $_POST['price'] ?? ''; 
$category_id= $_POST['category_id'] ?? ''; //categorias
$message = '';

//ingresar datos
if ($barcode && $name && $stock && $price) {
	$query = $conn->prepare('INSERT INTO products (barcode, name, stock, price, category_id) VALUES (:barcode, :name, :stock, :price, :category_id)');
	$query->bindParam(':barcode', $barcode, PDO::PARAM_INT);
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':stock', $stock, PDO::PARAM_INT);
	$query->bindParam(':price', $price, PDO::PARAM_INT);
	$query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
	$query->execute();

	//verificar datos
	if ($query === TRUE) {		
			echo  'producto registrado';
			header('location: /products.php');
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
	<title>PRODUCTOS</title>
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
					Ingrese la Información de los productos
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
			<a href="#tabListProducts" class="mdl-tabs__tab is-active">LISTA DE PRODUCTOS</a>
			<a href="#tabNewProduct" class="mdl-tabs__tab ">INGRESAR NUEVO PRODUCTO</a>				
			</div>
			<!-- Tabla para ingresar productos -->
			<div class="mdl-tabs__panel" id="tabNewProduct">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Producto nuevo
							</div>
							<div class="full-width panel-content">
								<!-- =====  comienza el formulario ====== -->
								<form action='products.php' method='POST'>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Información Básica</h5>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input type="number" name="barcode" class="mdl-textfield__input"  pattern="-?[0-9- ]*(\.[0-9]+)?" id="BarCode">
												<label class="mdl-textfield__label" for="BarCode">Código de Barras</label>
												<span class="mdl-textfield__error">Código de Barras inválido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input type="text" name="name" class="mdl-textfield__input"  pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" id="NameProduct">
												<label class="mdl-textfield__label" for="NameProduct">Nombre</label>
												<span class="mdl-textfield__error">Nombre inválido</span>
											</div>
											<!-- select de categorias -->
											<div class="mdl-textfield mdl-js-textfield">
												<h5>Selecciona una categoria</h5>
												<select name="category_id" class="mdl-textfield__input">
													<?php
													$query=$conn->query('SELECT id, name FROM categories');
													$rows = $query->fetchAll();
													?>

													<?php foreach($rows as $row): ?>
														<option value="<?php echo $row['id'] ?>">
															<?php echo $row['name'] ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div><!-- select de categorias -->

											<h5 class="text-condensedLight">Cantidades y Precios</h5>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input type="number" name="stock" class="mdl-textfield__input"  pattern="-?[0-9]*(\.[0-9]+)?" id="StrockProduct">
												<label class="mdl-textfield__label" for="StrockProduct">Cantidad de Entrada</label>
												<span class="mdl-textfield__error">Cantidad inválido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input type="text" name="price" class="mdl-textfield__input"  pattern="-?[0-9.]*(\.[0-9]+)?" id="PriceProduct">
												<label class="mdl-textfield__label" for="PriceProduct">Precio por Pieza</label>
												<span class="mdl-textfield__error">Precio inválido</span>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Proveedor</h5>
											<div class="mdl-textfield mdl-js-textfield">
												<select class="mdl-textfield__input">
													<?php
														$query=$conn->query('SELECT id, name FROM providers');
														$rows = $query->fetchAll();
													?>
													<?php foreach($rows as $row): ?>
														<option value="<?php echo $row['id'] ?>">
															<?php echo $row['name'] ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>										
											<!-- subir imagen del producto -->
											<div class="mdl-textfield mdl-js-textfield">
												<input type="file" name='picture'>
											</div> 
										</div>
									</div>
									<p class="text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addProduct">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addProduct">Ingresar Producto</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- LISTA DE PRODUCTOS -->
			<div class="mdl-tabs__panel is-active" id="tabListProducts">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
					<!-- FORMULARIO DE BUSQUEDA DE PRODUCTOS 	
					<form action="#">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
								<label class="mdl-button mdl-js-button mdl-button--icon" for="searchProduct">
									<i class="zmdi zmdi-search"></i>
								</label>
								<div class="mdl-textfield__expandable-holder">
									<input class="mdl-textfield__input" type="text" id="searchProduct">
									<label class="mdl-textfield__label"></label>
								</div>
							</div>
						</form> -->
						<nav class="full-width menu-categories">
						<?php
							$querylist = 'SELECT id, name from categories';
							$stm = $conn->query($querylist);
							$rows = $stm->fetchAll();
						?>
							<ul class="list-unstyle text-center">
								<?php foreach($rows as $row): ?>
									<li><a href="#!"><?php echo $row['name']; ?></a></li>
								<?php endforeach; ?>
								<li><a href="#!">Ver todos</a></li>
							</ul>							
						</nav>
						<!-- muestra de productos -->
						<?php
							$querylist = 'SELECT products.id, products.name, products.stock, categories.name as category
											FROM products 
											INNER JOIN categories ON products.category_id = categories.id;';
							$stm = $conn->query($querylist);
							$rows = $stm->fetchAll();
						?>
						
						<div class="full-width text-center" style="padding: 30px 0;">
							<?php foreach($rows as $row): ?>
							<div class="mdl-card mdl-shadow--2dp full-width product-card">							
								<div class="mdl-card__title">
									<img src="assets/img/fontLogin.jpg" alt="product" class="img-responsive">
								</div>
								<div class="mdl-card__supporting-text">
									<small><?php echo $row['stock']; ?></small><br>
									<small><?php echo $row['category']; ?></small>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									<?php echo $row['name']; ?>
									<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="menumore">
										<i class="zmdi zmdi-more"></i>
									</button>
								</div>							
							</div>
							<?php endforeach; ?> 						
						</div><!-- end container -->							
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>