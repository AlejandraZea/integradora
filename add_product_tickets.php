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
$stm = $conn->prepare("SELECT barcode, name, stock, price,  id FROM products
                        WHERE barcode=:barcode 
                        LIMIT 1");
$stm->bindParam(':barcode', $barcode);
$stm->execute();
$articulo = $stm->fetch();
$articulo['cantidad'] = 0;

if (!isset($_SESSION['ticket']) && !is_array($_SESSION['ticket'])){
	$_SESSION['ticket'] = [];
	$_SESSION['ticket'][] = $articulo;
} else {
	$found = false;
	foreach ($_SESSION['ticket'] as $index => $a){
		if ($a['barcode'] == $articulo['barcode']){
			$_SESSION['ticket'][$index]['cantidad'] += 1;
			$found = true;
			break;
		}
	}
	if (!$found){
		$_SESSION['ticket'][] = $articulo;
	}
}
header('location: /tickets.php');


