<?php include('includes/header.php');
include('config/conn.php');

?>
<!-- Navbar start -->

<?php include('includes/nav.php'); ?>

<!-- Navbar End -->



        <!-- Modal Search Start -->
        <?php include('includes/search_model.php'); 
        
       

        
        
        ?>

        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

    <?php
    // echo "<pre>";
    // print_r($_SESSION['cart']);
    // echo "</pre>";

    
    
    ?>
        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                       
                        if(!empty($_SESSION['main_user'])){
                            $cart_id  = '';
                            $user_id = $_SESSION['user_id'];
                            $cart_check = "SELECT * FROM cart WHERE user_id='$user_id'";
                            $cart_ex = mysqli_query($conn,$cart_check);
                            $cart_fetch = mysqli_fetch_assoc($cart_ex);
                            if(!empty($cart_fetch['id'])){
                                $cart_id  = $cart_fetch['id'];

                            }
                            $check_cart_items = "SELECT * FROM  cart_items WHERE cart_id='$cart_id'";
                            $check_cart_items_ex = mysqli_query($conn,$check_cart_items);
                            $check_cart_items_fetch = mysqli_fetch_all($check_cart_items_ex,MYSQLI_ASSOC);

                            $getCartItemsCountByCartId = getCartItemsCountByCartId($conn,$cart_id);


                            foreach($check_cart_items_fetch as $check_cart_item){ 
                                $product_id  = $check_cart_item['product_id'];
                                $getProductById = getProductById($conn,$product_id);
                              
                                $total_product_price = $check_cart_item['total_price'];
                                
                                ?>
                              


                                <tr id="table_of_product_<?= $getProductById['id'] ?>">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="admin/<?= $getProductById['product_image'] ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $getProductById['product_title'] ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $getProductById['price'] ?></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="cartIncrementOrDecrement('<?= $getProductById['id'] ?>',-1,'<?= $cart_id ?>')" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0" value="<?= $check_cart_item['quantity']?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="cartIncrementOrDecrement('<?= $getProductById['id'] ?>',1,'<?= $cart_id ?>')">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4" id="price_<?= $product_id ?>"><?= $total_product_price ?></p>
                                    </td>
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4" onclick="removeCartProduct('<?= $getProductById['id'] ?>','<?= $cart_id ?>')" >
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                
                                </tr>




                         <?php    }
                            


                        }else{

                            if(!empty($_SESSION['cart'])){

                                foreach($_SESSION['cart'] as $cart){
                                $product_id = $cart['product_id'];
                                $getProductById = getProductById($conn,$product_id);
                                $total_product_price = $cart['price'];
                               
    
                                ?>
                             <tr id="table_of_product_<?= $getProductById['id'] ?>">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="admin/<?= $getProductById['product_image'] ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $getProductById['product_title'] ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $getProductById['price'] ?></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="cartIncrementOrDecrement('<?= $getProductById['id'] ?>',-1)" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0" value="<?php 
                                            if(!empty($_SESSION['cart'][$product_id])){
                                                echo $_SESSION['cart'][$product_id]['quantity'];
                                            }
                                            
                                            ?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="cartIncrementOrDecrement('<?= $getProductById['id'] ?>',1)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4" id="price_<?= $product_id ?>"><?= $total_product_price ?></p>
                                    </td>
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4" onclick="removeCartProduct('<?= $getProductById['id'] ?>')" >
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                
                                </tr>
    
    
    
                          <?php  
                          
                        }
                    
                    }

                            
                        }

                        
                        ?>
                       
                         
                      
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" id="coupon_code" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" id="apply_coupon" type="button">Apply Coupon</button>
                </div>
                <div id="coupon_status"></div>

                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0" id="subtotal">
                                        <?php 
            if(!empty($_SESSION['main_user'])){
                $getSubtotalByCartId = getSubtotalByCartId($conn,$cart_id);
                echo $getSubtotalByCartId;


            }else{
                if(!empty($_SESSION['price_subtotal'])){
                    echo $_SESSION['price_subtotal'];
                }else{
                    echo 0;
                }
            }

                     

                                ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                
                                    <h5 class="mb-0 me-4">Coupon</h5>
                               
                                    <div class="">
                                        <p class="mb-0" id="coupon_code_applied">
                                                <?php if(!empty($cart_fetch['coupon_code'])){
                                                        echo $cart_fetch['coupon_code'].'  '.'-'.$cart_fetch['discount'];
                                                } ?>

                                        </p>
                                        <div id="remove_coupon_btn">
                                                <?php if(!empty($cart_fetch['coupon_code'])){?>

                                                <button  class="btn btn-danger">Remove</button>

                                                <?php   } ?>
                                        </div>
                           

                                    </div>
                                </div>
                               

                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4" id="total"><?php 

if(!empty($_SESSION['main_user'])){
echo $cart_fetch['final_price'];

}else{
    if(!empty($_SESSION['price_total'])){
        echo $_SESSION['price_total'];
     }else{
        echo 0;
     }
}
                            
                                
                                
                                
                                ?></p>
                            </div>
                            <a href="checkout.php">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->

        <?php include('includes/footer.php'); ?>


        <script>
            function cartIncrementOrDecrement(product_id,type,cart_id=''){
                $.ajax({
                    url:"cart_increment_or_decrement.php",
                    type:'post',
                    data:{
                        product_id:product_id,
                        type:type,
                        cart_id:cart_id
                    }
                ,
                success:function(res){
                    let price;
                    let response = JSON.parse(res)

                    console.log(response)
                    if(response.type=="with_user"){
                  
                        if(!response.cart_items){
                            $("#table_of_product_"+product_id).remove()

                        }else{
                        $("#price_"+product_id).html(response.cart_items.total_price)
                        $("#total").html(response.total_price)
                        $("#subtotal").html(response.sub_total)
                        }


                    }else{
                     if(response.cart[product_id]){
                        price = response.cart[product_id].price
                        $("#price_"+product_id).html(price)

                    }else{
                        $("#table_of_product_"+product_id).remove()

                    }
                    $("#subtotal").html(response.price_subtotal)
                     $("#cart_count").html(response.cart_count)
                     $("#total").html(response.price_total)
                    }
               


                }
                })
                

            }



















    function removeCartProduct(id,cart_id=''){
        $.ajax({
            url:'remove_cart_product.php',
            type:'post',
            data:{
                product_id:id,
                cart_id:cart_id
            },
            success:function(res){
                let response = JSON.parse(res)
                console.log(response)
                if(response.type=='main_user'){
                    $("#table_of_product_"+id).remove()
                    $("#cart_count").html(response.cart_count)
                    $("#subtotal").html(response.sub_total)
                    $("#total").html(response.total_price)


                }else{
                $("#table_of_product_"+id).remove()
                $("#cart_count").html(response.cart_count)
                $("#subtotal").html(response.price_subtotal)
                $("#total").html(response.price_total)
                }

            

            }
        })
        
    }
    $("#apply_coupon").on("click",function(){
        let coupon_code = $("#coupon_code").val()
        $.ajax({
            url:'apply_coupon.php',
            type:'post',
            data:{
                coupon_code:coupon_code 
            },
            success:function(res){
                let response = JSON.parse(res)
                console.log(response)
                // coupon_status
                if(response.status=='ok'){
                    $("#coupon_status").html(response.msg)
                    $("#coupon_code_applied").html('<b>'+response.cart.coupon_code+'</b>'+'  '+(-response.cart.discount))
                    $("#remove_coupon_btn").html('<button  class="btn btn-danger">Remove</button>')
                    $("#total").html(response.cart.final_price)


                }else{
                    $("#coupon_status").html(response.msg)
                }
   
            }
        })
       
      
    })
    $("#remove_coupon_btn").on("click",function(){
     
        $.ajax({
            url:'remove_coupon.php',
            type:'post',
            success:function(res){
                let response = JSON.parse(res)
                console.log(response)
                if(response.status=='ok'){
                    $("#remove_coupon_btn").html('')
                    $("#coupon_code_applied").html('<b>'+response.cart.coupon_code+'</b>'+'  '+(-response.cart.discount))
                    $("#total").html(response.cart.final_price)


                }

            }
        })
       
    })
        </script>