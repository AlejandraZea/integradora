<?php
session_start(); 
require_once ('conexion.php'); 

$barcode = $_POST['barcode'] ?? ''; 
/*
$articulo = [
	'barcode' => $barcode,
	'name' => $name,
    'price' => $price,
	'cantidad' => 1,
    'id' => $id    
]; 
*/
$stm = $conn->prepare("SELECT barcode, name, stock, price as price_unit,  id as product_id FROM products
                        WHERE barcode=:barcode 
                        LIMIT 1");
$stm->bindParam(':barcode', $barcode);
$stm->execute();
$articulo = $stm->fetch();

if($articulo != null) {
	$articulo['quantity'] = 1;

	if (!isset($_SESSION['ticket']) && !is_array($_SESSION['ticket'])){
		$_SESSION['ticket'] = [];
		$_SESSION['ticket'][] = $articulo;
	} else {
		$found = false;
		foreach ($_SESSION['ticket'] as $index => $a){
			if ($a['barcode'] == $articulo['barcode']){
				$_SESSION['ticket'][$index]['quantity'] += 1;
				$found = true;
				break;
			}
		}
		if (!$found){
			$_SESSION['ticket'][] = $articulo;
		}
	}
}

header('location: /tickets.php');
