<?php 
session_start();
include('config/conn.php');
include("includes/functions.php");
$coupon_code = $_POST['coupon_code'];

$coupons_sql_check = "SELECT * FROM coupons WHERE code='$coupon_code'";
$coupons_sql_ex = mysqli_query($conn,$coupons_sql_check);
$coupons = mysqli_fetch_assoc($coupons_sql_ex);
if(!empty($coupons)){
    $user_id = $_SESSION['user_id'];
    $cart_id = getCartIdByUser($conn,$user_id);
    $total_price = getSubtotalByCartId($conn,$cart_id);
    if($total_price>$coupons['min_cart']){
        $discount = $coupons['discount'];
        if($coupons['coupon_type']==1){
            $fnl_discount = ($total_price*$discount)/100;
        }else{
            $fnl_discount = $discount;
        }
        $tax =0;
     
        $final_price =$total_price-$fnl_discount+$tax;
        $cart_update = "UPDATE cart SET final_price='$final_price',coupon_code='$coupon_code',discount='$fnl_discount',total_price='$total_price' WHERE id='$cart_id'";
        
        if(mysqli_query($conn,$cart_update)){
            }
        $cart_update_ex  = mysqli_query($conn,$cart_update);
    
        $sql_cart = "SELECT * FROM cart WHERE id='$cart_id'";
        $sql_cart_ex  = mysqli_query($conn,$sql_cart);
        $cart = mysqli_fetch_assoc($sql_cart_ex);
    
        echo json_encode(['status'=>'ok','msg'=>'coupon applied','cart'=>$cart]);
    }else{
        echo json_encode(['status'=>'nok','msg'=>'min cart amount is '.$coupons['min_cart']]);

    }
 

}else{
    echo json_encode(['status'=>'nok','msg'=>'coupon data not found']);
}




?>