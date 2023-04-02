<?php
	session_start();//iniciar sesion
	require_once('conexion.php'); // conexion a la base de datos
	//variables
	$id = isseT($_GET['id']) ? $_GET['id']: '' ;
	$message= '';

	$qry= 'SELECT COUNT(id) FROM users';
	$stm = $conn->query($qry);
	$counts = $stm->fetchAll();	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>REGISTROS</title>
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
		<section class="full-width text-center" style="padding: 40px 0;">
			<h3 class="text-center tittles">REGISTROS</h3>
			<!-- TITULOS -->

			<!-- seccion usuarios -->
			<article class="full-width tile">
				<a href="admin.php"><div class="tile-text">
					<span class="text-condensedLight">
						<?php echo $id; ?> <br>
						<small>USUARIOS</small>
					</span>
				</div>
				<i class="zmdi zmdi-account tile-icon"></i>
				</a>
			</article><!-- end seccion usuarios -->

			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						71<br>
						<small>Clientes</small>
					</span>
				</div>
				<i class="zmdi zmdi-accounts tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						7<br>
						<small>Proveedores</small>
					</span>
				</div>
				<i class="zmdi zmdi-truck tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						9<br>
						<small>Categorías</small>
					</span>
				</div>
				<i class="zmdi zmdi-label tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						121<br>
						<small>Productos</small>
					</span>
				</div>
				<i class="zmdi zmdi-washing-machine tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						47<br>
						<small>Ventas</small>
					</span>
				</div>
				<i class="zmdi zmdi-shopping-cart tile-icon"></i>
			</article>
		</section>
	</section>
</body>
</html>