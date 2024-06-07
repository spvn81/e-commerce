<?php
include('includes/header.php'); 
if(!isset($_SESSION['main_user'])){
    echo "<script>window.location='login.php'</script>";
}

?>


    
<!-- Navbar start -->

<?php include('includes/nav.php'); ?>

<!-- Navbar End -->



        <!-- Modal Search Start -->
        <?php include('includes/search_model.php'); ?>

        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->
        <?php


    
    
    ?>



        <?php 
        include('config/conn.php');
        $errors = [];
        $loin_user_fetch='';

        if(isset($_POST['submit'])){
      

            if(!empty($_POST['accounts'])){
                $full_name = $_POST['full_name'];
                $address = $_POST['address'];
                $town_or_city = $_POST['town_or_city'];
                $country = $_POST['country'];
                $postcode = $_POST['postcode'];
                $mobile = $_POST['mobile'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
                $user_role = 2;
                $status = 1;

                $check_user = "SELECT * FROM users WHERE email='$email'";
                $check_user_ex  = mysqli_query($conn,$check_user);
                $check_user_fetch = mysqli_fetch_assoc($check_user_ex);
                if(empty($check_user_fetch)){
                    $users_sql = "INSERT INTO users (full_name,email,mobile,password,address,town_or_city,country,postcode,user_role,status) 
                    VALUES('$full_name','$email','$mobile','$password','$address','$town_or_city','$country','$postcode','$user_role',$status)";
                    if(mysqli_query($conn,$users_sql)){
                        $_SESSION['main_user'] = true;
                        $_SESSION['main_user_email'] = $email;
                }
            




                }else{
                    $errors['user_exist'] =  "User Already exist";
                    $_SESSION['check_out_login'] = true;
                }
    
            }
    



        }

         if(!empty($_SESSION['main_user'])){
            $main_user_email = $_SESSION['main_user_email'];
            $loin_user = "SELECT * FROM users WHERE email='$main_user_email'";
            $loin_user_ex  = mysqli_query($conn,$loin_user);
            $loin_user_fetch = mysqli_fetch_assoc($loin_user_ex);
         }

  

            ?>


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>

              
                <?php 
                if(!empty($errors['user_exist'])){
                    echo $errors['user_exist'];
                }

              

                ?>
                <form method="post">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Full Name<sup>*</sup></label>
                                        <input type="text" name="full_name" value="<?= !empty($loin_user_fetch['full_name'])?$loin_user_fetch['full_name']:'' ?>" class="form-control">
                                    </div>
                                </div>
                         
                            </div>
                         
                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" class="form-control" value="<?= !empty($loin_user_fetch['address'])?$loin_user_fetch['address']:'' ?>" name="address" placeholder="House Number Street Name">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Town/City<sup>*</sup></label>
                                <input type="text" class="form-control"  value="<?= !empty($loin_user_fetch['town_or_city'])?$loin_user_fetch['town_or_city']:'' ?>"  name="town_or_city">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Country<sup>*</sup></label>
                                <input type="text" class="form-control" name="country"   value="<?= !empty($loin_user_fetch['country'])?$loin_user_fetch['country']:'' ?>">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                                <input type="text" class="form-control" name="postcode"    value="<?= !empty($loin_user_fetch['postcode'])?$loin_user_fetch['postcode']:'' ?>">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input type="tel" class="form-control" name="mobile" value="<?= !empty($loin_user_fetch['mobile'])?$loin_user_fetch['mobile']:'' ?>">
                            </div>
                         
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" name="email"   value="<?= !empty($loin_user_fetch['email'])?$loin_user_fetch['email']:'' ?>"  <?= !empty($loin_user_fetch['email'])?"readonly":'' ?> >
                            </div>

                            <?php if(empty($loin_user_fetch)){ ?>
                            <div class="form-item">
                                <label class="form-label my-3">Password<sup>*</sup></label>
                                <input type="password" class="form-control" name="password" >
                            </div>

                            <div class="form-check my-3">
                                <input type="checkbox"  class="form-check-input" id="Account-1" name="accounts" value="Accounts">
                                <label class="form-check-label" for="Account-1">Create an account?</label>
                            </div>


                            <?php } ?>


                          
                         
                       
                        
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <?php 

                                $cart_id = getCartIdByUser($conn,$_SESSION['user_id']);
                                $cart_items_of_sql = "SELECT * FROM cart_items INNER JOIN products ON cart_items.product_id=products.id  WHERE cart_items.cart_id='$cart_id'";
                                $cart_items_of_ex = mysqli_query($conn,$cart_items_of_sql);
                                $cart_items = mysqli_fetch_all($cart_items_of_ex,MYSQLI_ASSOC);


                                $sql_cart = "SELECT * FROM cart WHERE id='$cart_id'";
                                $sql_cart_ex  = mysqli_query($conn,$sql_cart);
                                $sql_cart_fetch = mysqli_fetch_assoc($sql_cart_ex);




                                ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach( $cart_items as  $cart_items_data){ ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="<?= 'admin/'.$cart_items_data['product_image'] ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><?= $cart_items_data['product_title'] ?></td>
                                            <td class="py-5"><?= $cart_items_data['price'] ?></td>
                                            <td class="py-5"><?= $cart_items_data['quantity'] ?></td>
                                            <td class="py-5"><?= $cart_items_data['total_price'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    
                                    
                                   
                              
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark"><?= $sql_cart_fetch['final_price']; ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1" name="Transfer" value="Transfer">
                                        <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                    </div>
                                    <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Payments-1" name="Payments" value="Payments">
                                        <label class="form-check-label" for="Payments-1">Check Payments</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                        <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                        <label class="form-check-label" for="Paypal-1">Paypal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" name="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->

        <?php include('includes/footer.php'); ?>