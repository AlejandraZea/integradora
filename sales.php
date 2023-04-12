<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ventas</title>
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
					Reporte de ventas
				</p>
			</div>
		</section>
		<div class="full-width divider-menu-h"></div>
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
				<?php
					$querylist = 'SELECT tickets.id, tickets.user_id, tickets.date, tickets.amount, users.name AS user 
									FROM tickets
									INNER JOIN users ON tickets.user_id = users.id';
					$stm = $conn->query($querylist);
					$rows = $stm->fetchAll();
				?>		
					<thead>						
						<tr>
							<th class="mdl-data-table__cell--non-numeric">No. Ticket</th>
							<th class="mdl-data-table__cell--non-numeric">Fecha</th>
							<th class="mdl-data-table__cell--non-numeric">Usuario</th>
							<th >Total</th>
						</tr>						
					</thead>
					<tbody>
						<?php foreach ($rows as $row): ?>							
								<tr>
										<td class="mdl-data-table__cell--non-numeric"><?php echo $row['id']; ?></td>
										<td class="mdl-data-table__cell--non-numeric"><?php echo $row['date']; ?></td>										
										<td class="mdl-data-table__cell--non-numeric"><?php echo $row['user']; ?></td><!-- hacer un inner join para mostrar el nombre del usuario -->
										<td>$ <?php echo $row['amount']; ?></td>
										<td>
											<!-- boton para detalle de ticket -->
											<a href="view_ticket.php?id=<?php echo $row['id']; ?>">
												<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
													Ver Ticket
												</button>
											</a>
										</td>
								</tr>							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</body>
</html>