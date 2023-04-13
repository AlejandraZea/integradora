<?php
session_start(); //se crea una sesion o reanuda la actual basada en un identificador para el navegador
require_once ('conexion.php'); //conexion a la base de datos


// comprobar que si traiga info el ticket y que exista
if (empty($_GET['id'])){
    echo "No existen Regitros";
    exit();
}

$stm = $conn->prepare("SELECT tickets.*, users.name, users.lastname 
                        FROM tickets
                        INNER JOIN users ON users.id = tickets.user_id
                        WHERE tickets.id = :ticket_id");
$stm -> bindParam(':ticket_id', $_GET['id']);
$stm->execute();
$ticket = $stm->fetch();

if (empty($ticket)){
    echo "No existen Regitros";
    exit();
}

//si existe traer todos los articulos con descripción y nombres
//con inner join
    $statement = $conn->prepare("SELECT 
        ticket_products.*, products.barcode, products.name
        FROM ticket_products
        INNER JOIN products ON ticket_products.product_id = products.id 
        WHERE ticket_id=:ticket_id");
    $statement->bindParam(":ticket_id", $_GET['id'], PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetchAll();
    

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detalle de Ticket</title>
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
                <h3 class="text-left tittles">DETALLE DE TICKET</h3>
				</p>
			</div>
		</section>
        

        <div class="full-width divider-menu-h"></div>
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                <h2> Ticket No. <?php echo $_GET['id']; ?></h2>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--8-col">
                        Nombre usuario: <?php echo $ticket['name']; ?>  <?php echo $ticket['lastname']; ?>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        Fecha: <?php echo $ticket['date']; ?>
                    </div>
                </div>
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
					<thead>						
						<tr>
                            <th class="mdl-data-table__cell--non-numeric">Barcode</th>
							<th class="mdl-data-table__cell--non-numeric">Cantidad</th>
							<th class="mdl-data-table__cell--non-numeric">Nombre Producto</th>
							<th class="mdl-data-table__cell--non-numeric">Precio</th>
                            <th class="mdl-data-table__cell--non-numeric">Total</th>
						</tr>						
					</thead>
					<tbody>	
                        <?php foreach ($rows as $row): ?>					
                            <tr>                                
                                <td class="mdl-data-table__cell--non-numeric"><?php  echo $row['barcode']; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php  echo $row['quantity']; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php  echo $row['name']; ?></td>											
                                <td class="mdl-data-table__cell--non-numeric">$ <?php  echo $row['price_unit']; ?></td>
                                <td class="mdl-data-table__cell--non-numeric">$ <?php  echo $row['price']; ?> </td>  
                            </tr>	
                        <?php endforeach; ?>		
					</tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="mdl-data-table__cell--non-numeric">$ <?php echo $ticket['amount']; ?></td>
                        </tr>
                    </tfoot>
				</table>
                    <!-- boton para eliminar ticket -->
                    <div style="text-align: right; padding: 10px">
                        <a href="delete_ticket.php?id=<?php echo $_GET['id']; ?>">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                ELIMINAR
                            </button>
                        </a>
                    </div>
			</div>
		</div>



		
	</section>
</body>
</html>