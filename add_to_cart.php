<?php
include('config/conn.php');
include('includes/functions.php');
session_start();
$product_id = $_POST['product_id'];
$products_sql = "SELECT * FROM products WHERE id='$product_id'";
$product_ex = mysqli_query($conn,$products_sql);
$product_fetch = mysqli_fetch_assoc($product_ex);

$price = $product_fetch['price'];
$total_price = $price*1;

if(!empty($_SESSION['main_user'])){
    $user_id = $_SESSION['user_id'];
    $cart_id = getCartIdByUser($conn,$user_id);
    if(empty($cart_id)){
        $cart_sql_insert = "INSERT INTO cart (user_id,total_price,tax,final_price) VALUES('$user_id',0,0,0)";
        $cart_sql_ex = mysqli_query($conn,$cart_sql_insert);
    }
    $cart_id = getCartIdByUser($conn,$user_id);
    $cart_items = "SELECT * FROM cart_items  WHERE cart_id='$cart_id' AND product_id='$product_id'";
    $cart_items_ex  = mysqli_query($conn,$cart_items);
    $cart_items_fetch = mysqli_fetch_assoc($cart_items_ex);
    if(empty($cart_items_fetch)){
        $cart_items_insert_sql = "INSERT INTO cart_items (cart_id,product_id,price,quantity,total_price)
        VALUES('$cart_id','$product_id','$price',1,$total_price)";
        $cart_items_insert_ex = mysqli_query($conn,$cart_items_insert_sql);
        $getSubtotalByCartId = getSubtotalByCartId($conn,$cart_id);
        $cart_update = "UPDATE cart SET total_price='$getSubtotalByCartId',final_price='$getSubtotalByCartId' WHERE id='$cart_id'";
        $cart_update_ex  = mysqli_query($conn,$cart_update);
    }
    $cart_count = getCartItemsCountByCartId($conn,$cart_id);
    echo  json_encode(['cart'=>'','cart_count'=>$cart_count]);



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