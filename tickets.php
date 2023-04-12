<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos

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
										<div class="mdl-textfield mdl-js-textfield">
											<input type="text" name="barcode" class="mdl-textfield__input"  id="sample2">
											<label class="mdl-textfield__label" for="sample2">CODIGO DE BARRAS</label>
										</div>	
										<div style="text-align: left; padding: 10px" >
											<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">agregar</button>
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
												<h2 class="mdl-card__title-text">Ticket de Venta</h2>
											</div>

											<div class="mdl-card__supporting-text-responsive">
												<form action="create_ticket.php" method="POST">
													<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
															<thead>
																<tr>
																<th>#</th>
																<th class="mdl-data-table__cell--non-numeric">Producto</th>
																<th>Cantidad</th>
																<th>Precio</th>
																<th>Total</th>
																</tr>
															</thead>
															
															<tbody>															
																<?php if (count($_SESSION['ticket']) == 0): ?>
																	<tr>
																		<td colspan="5" style="text-align: center"><?php echo "Agrega un articulo"; ?></td>
																	</tr>
																<?php endif; ?>
																<!-- iteramos los productos marcados -->
																<?php 
																	$total = 0;
																	$quantity = 0;
																	foreach($_SESSION['ticket'] as $index => $product): 
																?>
																	<tr>
																	<td><?php echo $index +1; ?></td>
																	<td class="mdl-data-table__cell--non-numeric"><?php echo $product['name'] ; ?></td>
																	<td><?php echo $product['quantity']; ?></td>
																	<td>$ <?php echo $product['price_unit']; ?></td>
																	<td>$ <?php echo number_format($product['price_unit'] * $product['quantity'],2,'.',','); ?></td>
																	</tr>
																<?php 
																	$total += $product['price_unit'] * $product['quantity'];
																	$quantity += $product['quantity'];
																	endforeach; 
																?>															
															</tbody>														
													</table>
													<div class="mdl-card__actions mdl-card--border mdl-card__actions_tickets">
														<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
															Total productos: <?php echo $quantity; ?>
														</a>
														<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
															Total compra: $ <?php echo number_format($total,2,'.',','); ?>
														</a>
													</div>
													</div>
													<div style="text-align: right; padding: 10px" >
														<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">TERMINAR</button>
													</div>
												</form> <!-- end form -->
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