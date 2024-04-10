<?php 
include('config/conn.php');
include("includes/functions.php");
$coupon_code = $_POST['coupon_code'];

$coupons_sql_check = "SELECT * FROM coupons WHERE code='$coupon_code'";
$coupons_sql_ex = mysqli_query($conn,$coupons_sql_check);
$coupons = mysqli_fetch_assoc($coupons_sql_ex);
if(!empty($coupons)){

    echo json_encode(['status'=>'ok','msg'=>'coupon applied']);

}else{
    echo json_encode(['status'=>'nok','msg'=>'coupon data not found']);
}




?>