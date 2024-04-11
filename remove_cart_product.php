<?php
include('config/conn.php');
include('includes/functions.php');
session_start();
$product_id = $_POST['product_id'];
$cart_id = !empty($_POST['cart_id'])?$_POST['cart_id']:'';




$tax = 0;
$price_subtotal=0;
if(!empty($_SESSION['main_user'])){

   $cart_item_delete = "DELETE  FROM cart_items  WHERE cart_id='$cart_id' AND product_id='$product_id'";
   $cart_item_delete_ex  = mysqli_query($conn,$cart_item_delete);
   $count = getCartItemsCountByCartId($conn,$cart_id);
   $getSubtotalByCartId = getSubtotalByCartId($conn,$cart_id);
   $cart_update = "UPDATE cart SET final_price='$getSubtotalByCartId' WHERE id='$cart_id'";
   $cart_update_ex  = mysqli_query($conn,$cart_update);
   
   $sub_total = getSubtotalByCartId($conn,$cart_id);
   $sql_cart = "SELECT * FROM cart WHERE id='$cart_id'";
   $sql_cart_ex  = mysqli_query($conn,$sql_cart);
   $sql_cart_fetch = mysqli_fetch_assoc($sql_cart_ex);
   $total_price = $sql_cart_fetch['final_price'];

 



   echo  json_encode(['cart'=>$cart_item_delete_ex,'type'=>'main_user','cart_count'=>$count,'sub_total'=>$sub_total,'total_price'=>$total_price]);



}else{
unset($_SESSION['cart'][$product_id]);
$_SESSION['cart_count'] = count($_SESSION['cart']);
   foreach($_SESSION['cart'] as $cart_data){
      $price_subtotal += $cart_data['price'];
   }
   $_SESSION['price_subtotal'] =$price_subtotal;
   $_SESSION['price_total'] =$price_subtotal+$tax;
   
   
   
   echo  json_encode($_SESSION);
}





?>