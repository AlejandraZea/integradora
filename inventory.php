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
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INVENTARIOS</title>
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
					Inventario en Tienda
				</p>
			</div>
		</section>
		<div class="full-width divider-menu-h"></div>
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
				<?php
					$querylist = 'SELECT products.id, products.barcode, products.name, products.stock, products.price, categories.name as category
									FROM products 
									INNER JOIN categories ON products.category_id = categories.id;';
					$stm = $conn->query($querylist);
					$rows = $stm->fetchAll();
				?>					
					<thead><!-- titulo de la tabla -->
						<tr>
							<th class="mdl-data-table__cell--non-numeric">Nombre</th>
							<th>Barcode</th>
							<th>Categoría</th>
							<th>Existencias</th>
							<th>Precio</th>
							<th>Options</th>
						</tr>
					</thead>					
					<tbody><!-- cuerpo de la tabla -->
						<?php foreach($rows as $row): ?>
							<tr>
								<td class="mdl-data-table__cell--non-numeric"><?php echo $row['name']; ?></td>
								<td><?php echo $row['barcode']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><?php echo $row['stock']; ?></td>
								<td><?php echo $row['price']; ?></td>
								<td><a href="edit_products.php"><button class="mdl-button mdl-js-button mdl-button--primary">Editar</button></a>
								<a href="delete_products.php"><button class="mdl-button mdl-js-button mdl-button--accent">Eliminar</button></a></td>							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</body>
</html>