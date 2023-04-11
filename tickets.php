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
	<title>TICKETS</title>
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
			<div class="full-width header-well-text">
				
				<p class="text-condensedLight">
					<img src="/assets/img/logo.store.png" alt="logo" width="250px">
					Supermarket Store
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<!-- Tabla para ingresar productos -->
			<div class="mdl-tabs__panel is-active" id="tabNewProduct">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								VENTA
							</div>
							<!-- Textfield with Floating Label -->
							<div class="full-width panel-content">

								<div class="mdl-grid">
								<!-- =====================================================
											FORMULARIO DE CODIGO DE BARRAS
									 ====================================================== -->
									<form action="add_product_tickets.php" method="POST">
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
											<input type="text" name="barcode" class="mdl-textfield__input"  id="sample3">
											<label class="mdl-textfield__label" for="sample3">CODIGO DE BARRAS</label>
										</div>
									</form>	<!-- end form -->				
								</div>
								<!-- =====================================================
											FORMULARIO DE VISTA DE TICKET
									 ====================================================== -->
									
								<div class="mdl-grid">										
									<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
										<div class="demo-card-square mdl-card mdl-shadow--2dp">										
											<div class="mdl-card__title mdl-card--expand">												
												<h2 class="mdl-card__title-text">Ticket No. #</h2>
											</div>

											<div class="mdl-card__supporting-text-responsive">
											<form action="add_products_tickets.php" method="GET">
												<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
														<thead>
															<tr>
															<th class="mdl-data-table__cell--non-numeric">Producto</th>
															<th>Cantidad</th>
															<th>Precio</th>
															<th>Total</th>
															</tr>
														</thead>
														<?php
															$query=("SELECT barcode, name, stock, price,  id FROM products
																				 WHERE barcode = barcode");
															$stm = $conn->query($query);						 
															$rows = $stm->fetchAll();
														?>
														<tbody>
															<tr>
															<td class="mdl-data-table__cell--non-numeric">nombre</td>
															<td>22</td>
															<td>22</td>
															<td>22</td>
															</tr>
														</tbody>
												</table>
											</form> <!-- end form -->

											</div>
											<div class="mdl-card__actions mdl-card--border mdl-card__actions_tickets">
											<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												Total productos:
												</a>
												<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												Total compra:
												</a>
											</div>
											</div>
										</div>
									</div>
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