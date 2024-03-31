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