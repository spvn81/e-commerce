<?php
include('config/conn.php');

session_start();
$product_id = $_POST['product_id'];
$products_sql = "SELECT * FROM products WHERE id='$product_id'";
$product_ex = mysqli_query($conn,$products_sql);
$product_fetch = mysqli_fetch_assoc($product_ex);
$price = $product_fetch['price'];
if(!empty($_SESSION['main_user'])){

}else{
if(empty($_SESSION['temp_user'])){
    $rand_temp_user =  rand(111111,99999);
}else{
    $rand_temp_user = $_SESSION['temp_user'];
}
$_SESSION['temp_user'] = $rand_temp_user;

$cart=[
    'product_id'=> $product_id,
    'price'=> $price,
    'quantity'=>1
];
$_SESSION['cart'][$product_id] =$cart;

$_SESSION['cart_count'] = count($_SESSION['cart']);


$tax = 0;
$price_subtotal=0;
foreach($_SESSION['cart'] as $cart_data){
   $price_subtotal += $cart_data['price'];
}
$_SESSION['price_subtotal'] =$price_subtotal;
$_SESSION['price_total'] =$price_subtotal+$tax;




echo  json_encode($_SESSION);





 


}





?>