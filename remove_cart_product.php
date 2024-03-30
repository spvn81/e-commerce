<?php
include('config/conn.php');
include('includes/functions.php');
session_start();
$product_id = $_POST['product_id'];
unset($_SESSION['cart'][$product_id]);
$_SESSION['cart_count'] = count($_SESSION['cart']);

$tax = 0;
$price_subtotal=0;
foreach($_SESSION['cart'] as $cart_data){
   $price_subtotal += $cart_data['price'];
}
$_SESSION['price_subtotal'] =$price_subtotal;
$_SESSION['price_total'] =$price_subtotal+$tax;



echo  json_encode($_SESSION);


?>