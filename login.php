<?php include('includes/header.php'); ?>



    
<!-- Navbar start -->

<?php include('includes/nav.php'); ?>

<!-- Navbar End -->

        <!-- Modal Search Start -->
        <?php include('includes/search_model.php'); ?>



        <?php 



include('config/conn.php');
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $sql_ex = mysqli_query($conn,$sql);
  $sql_fetch_data = mysqli_fetch_assoc($sql_ex);
  if(!empty( $sql_fetch_data )){
    $password_hash = $sql_fetch_data['password'];
   if(password_verify($password,$password_hash)){
    $_SESSION['main_user'] = true;
    $_SESSION['main_user_email'] = $email;
    $user_id = $sql_fetch_data['id'];
    $_SESSION['user_id'] = $user_id;


    $cart_check = "SELECT * FROM cart WHERE user_id='$user_id'";
    $cart_ex = mysqli_query($conn,$cart_check);
    $cart_fetch = mysqli_fetch_assoc($cart_ex);
    if(!empty($cart_fetch)){
      $cart_id = $cart_fetch['id'];
    }else{
    $cart_insert = "INSERT INTO cart (user_id,tax,final_price) VALUES('$user_id',0,0)";
    $cart_ex = mysqli_query($conn,$cart_insert);
    $cart_check = "SELECT * FROM cart WHERE user_id='$user_id'";
    $cart_ex = mysqli_query($conn,$cart_check);
    $cart_fetch = mysqli_fetch_assoc($cart_ex);
    $cart_id = $cart_fetch['id'];

    }
  
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";


    if(!empty($_SESSION['cart'])){
      foreach($_SESSION['cart'] as $cart_data){
        $product_id = $cart_data['product_id'];
        $price = $cart_data['price'];
        $quantity = $cart_data['quantity'];
        $total_price = $price*$quantity;


        $check_cart_items = "SELECT * FROM  cart_items WHERE cart_id='$cart_id' AND product_id='$product_id'";
        $check_cart_items_ex = mysqli_query($conn,$check_cart_items);
        $check_cart_items_fetch = mysqli_fetch_assoc($check_cart_items_ex);
        if(!empty($check_cart_items_fetch)){
          $cart_items_id = $check_cart_items_fetch['id'];
          $cart_items_update = "UPDATE cart_items SET 
          'price'='$price',quantity='$quantity',total_price='$total_price' WHERE id='$cart_items_id'";
          $cart_items_update_ex = mysqli_query($conn,$cart_items_update);


        }else{
          $cart_items_insert = "INSERT INTO cart_items (cart_id,product_id,price,quantity,total_price)
          VALUES('$cart_id','$product_id','$price','$quantity','$total_price')";
          $cart_items_insert_ex = mysqli_query($conn,$cart_items_insert);
        }
        




      }
      $cart_items_sum = "SELECT SUM(total_price)  as total_price FROM cart_items WHERE cart_id='$cart_id'";
      $cart_items_sum_ex = mysqli_query($conn,$cart_items_sum);
      $cart_items_sum_fetch = mysqli_fetch_assoc($cart_items_sum_ex);
   
      $total_price = $cart_items_sum_fetch['total_price'];

      $update_cart = "UPDATE cart SET final_price='$total_price' WHERE id='$cart_id'";
      $update_cart_ex = mysqli_query($conn,$update_cart);
      unset($_SESSION['cart']);
      unset($_SESSION['temp_user']);
      unset($_SESSION['cart_count']);
      unset($_SESSION['price_subtotal']);
      unset($_SESSION['price_total']);




    }


  if(!empty($_SESSION['check_out_login'])){
        echo "
        <script>
          window.location='checkout.php'
        </script>
      ";
    }else{
        echo "
        <script>
          window.location='index.php'
        </script>
      ";  
    }
 
    
   }else{
    echo "login failed";
   }

  }



}
  


?>

  


        <div class="container-fluid py-5 mt-5">
            <div class="container py-5 text-center">
                <div class="row justify-content-center">

                <form method="post">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3">Password<sup>*</sup></label>
                                <input type="password" class="form-control" name="password" >
                            </div>


                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" name="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Login</button>
                            </div>
                         
                       
                        
                        </div>
                    
                    </div>
                </form>
                 
                </div>
            </div>
        </div>
        <!-- 404 End -->


        <?php include('includes/footer.php'); ?>