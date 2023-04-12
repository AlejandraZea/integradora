<?php
session_start();
require_once ('conexion.php'); 

//$_SESSION['ticket'] = [];
// comprobar que la sesion ticket tiene datos
if(count($_SESSION['ticket']) > 0){
    // sumar el total del ticket foreach $_SESSION['tickets']
    $total = 0;
    foreach($_SESSION['ticket'] as $product){
        $total += $product['price_unit'] * $product['quantity'];
    }  
    // si tiene datos insertamos datos en la tabla de tickets
    $date = date('Y-m-d H:i:s');
    $sql = $conn->prepare("INSERT INTO tickets (user_id, date, amount) 
            VALUES (:user_id, :date, :amount)");
    $sql->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
    $sql->bindParam(':date', $date);
    $sql->bindParam(':amount', $total);
    $sql->execute();

    // obtener el id del ticket
    $ticket_id = $conn->lastInsertId();

    // poner otro foreach con la sesion ticket
    foreach ($_SESSION['ticket'] as $product){
        // cada uno de los productos se inserta en ticket product
        $price= $product['price_unit'] * $product['quantity'];

        $statement = $conn->prepare("INSERT INTO ticket_products (ticket_id, product_id, quantity, price_unit, price)
                                        VALUES (:ticket_id, :product_id, :quantity, :price_unit, :price)");
        $statement->bindParam(':ticket_id', $ticket_id);
        $statement->bindParam(':product_id', $product['product_id']);
        $statement->bindParam(':quantity', $product['quantity']);
        $statement->bindParam(':price_unit', $product['price_unit']);  
        $statement->bindParam(':price', $price);                          
        $statement->execute();      
    } 
}
$_SESSION['ticket'] = [];
header('location: /tickets.php');
