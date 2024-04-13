<?php
include('config/conn.php');
include('includes/functions.php');
session_start();
$product_id = $_POST['product_id'];
$type = $_POST['type'];
$cart_id = $_POST['cart_id'];


$getProductById = getProductById($conn,$product_id);
$product_price =$getProductById['price']; 
if(!empty($_SESSION['main_user'])){

    $cart_items = "SELECT * FROM cart_items  WHERE cart_id='$cart_id' AND product_id='$product_id'";
    $cart_items_ex  = mysqli_query($conn,$cart_items);
    $cart_items_fetch = mysqli_fetch_assoc($cart_items_ex);
    $quantity = $cart_items_fetch['quantity']+$type;
    $total_price = $cart_items_fetch['price']*$quantity;
    if($quantity<=0){
        $cart_item_delete = "DELETE  FROM cart_items  WHERE cart_id='$cart_id' AND product_id='$product_id'";
        $cart_item_delete_ex  = mysqli_query($conn,$cart_item_delete);


    }

    $cart_items_update = "UPDATE cart_items SET quantity='$quantity',total_price='$total_price' WHERE cart_id='$cart_id' AND product_id='$product_id'";
    $cart_items_update_ex  = mysqli_query($conn,$cart_items_update);
    $getSubtotalByCartId = getSubtotalByCartId($conn,$cart_id);


    $cart_update = "UPDATE cart SET total_price='$getSubtotalByCartId',final_price='$getSubtotalByCartId' WHERE id='$cart_id'";
    $cart_update_ex  = mysqli_query($conn,$cart_update);


    $cart_items = "SELECT * FROM cart_items  WHERE cart_id='$cart_id' AND product_id='$product_id'";
    $cart_items_ex  = mysqli_query($conn,$cart_items);
    $cart_items_fetch = mysqli_fetch_assoc($cart_items_ex);
    $sub_total = getSubtotalByCartId($conn,$cart_id);



    $cart_delete_check = "SELECT *  FROM cart_items  WHERE cart_id='$cart_id'";
    $cart_delete_check_ex  = mysqli_query($conn,$cart_delete_check);
    $cart_delete_check_fetch = mysqli_fetch_assoc($cart_delete_check_ex);

    if(empty($cart_delete_check_fetch)){

        $delete_cart = "DELETE FROM cart WHERE id='$cart_id'";
        $delete_cart_ex = mysqli_query($conn,$delete_cart);

    }

    $total_price =0;
    $sql_cart = "SELECT * FROM cart WHERE id='$cart_id'";
    $sql_cart_ex  = mysqli_query($conn,$sql_cart);
    $sql_cart_fetch = mysqli_fetch_assoc($sql_cart_ex);
    if(!empty($sql_cart_fetch['final_price'])){
        $total_price = $sql_cart_fetch['final_price'];

    }




    echo  json_encode(['cart_items'=>$cart_items_fetch,'total_price'=>$total_price,'sub_total'=>$sub_total,'type'=>'with_user']);








}else{
    $price = $_SESSION['cart'][$product_id]['price'];
    $quantity =  $_SESSION['cart'][$product_id]['quantity']+$type;
    $fnl_price = $quantity*$product_price;
    $_SESSION['cart'][$product_id]['price']= $fnl_price;
    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    if($_SESSION['cart'][$product_id]['quantity']<=0){
        unset($_SESSION['cart'][$product_id]);
    }
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