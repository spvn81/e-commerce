<?php 
session_start();
include('config/conn.php');
include("includes/functions.php");
$user_id = $_SESSION['user_id'];
$cart_id = getCartIdByUser($conn,$user_id);
$total_price = getSubtotalByCartId($conn,$cart_id);
$coupon_code ='';
$discount = 0;
$tax=0;
$final_price = $total_price+$tax;

$cart_update = "UPDATE cart SET final_price='$final_price',coupon_code='$coupon_code',discount='$discount',total_price='$total_price' WHERE id='$cart_id'";
if(mysqli_query($conn,$cart_update)){
    $sql_cart = "SELECT * FROM cart WHERE id='$cart_id'";
    $sql_cart_ex  = mysqli_query($conn,$sql_cart);
    $cart = mysqli_fetch_assoc($sql_cart_ex);
    echo json_encode(['status'=>'ok','msg'=>'coupon applied','cart'=>$cart]);

    }else{
        echo json_encode(['status'=>'nok','msg'=>'coupon removed failed']);

    }



?>