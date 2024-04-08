<?php include('layouts/header.php'); ?>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>




<?php include('./layouts/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php include('./layouts/breadcrumb.php'); ?>



    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">

      
    <div class="col-md-12">

    <?php 
    include('config/conn.php');
    $id = $_GET['id'];
    $get_coupons = "SELECT * FROM coupons WHERE id='$id'";
    $get_coupons_ex = mysqli_query($conn,$get_coupons);
    $get_coupon = mysqli_fetch_assoc($get_coupons_ex);


 

    if(isset($_POST['submit'])){
      $title = $_POST['title'];
      $description = $_POST['description'];
      $code = $_POST['code'];
      $coupon_type = $_POST['coupon_type'];
      $discount = $_POST['discount'];
      $start = $_POST['start'];
      $end = $_POST['end'];
      $min_cart = $_POST['min_cart'];


      $sql_coupon_update = "UPDATE coupons SET title='$title',description='$description',code='$code',coupon_type='$coupon_type',
      discount='$discount',start='$start',end='$end',min_cart='$min_cart' WHERE id='$id'";
      if(mysqli_query($conn,$sql_coupon_update)){
        echo " <script>
        window.location='coupons.php';
      </script>";
      }


      


    }





?>

    <form method="post" enctype= multipart/form-data>

  <div class="form-group">
    <label for="title"> title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= !empty($get_coupon['title'])?$get_coupon['title']:"" ?>" placeholder=" title">
  </div>

  <div class="form-group">
    <label for="title"> description</label>
    <textarea  class="form-control"  id="description" name="description"  ><?= !empty($get_coupon['description'])?$get_coupon['description']:"" ?></textarea>
  </div>

 
  <div class="form-group">
    <label for="code">code</label>
    <input type="text" class="form-control" id="code" name="code" value="<?= !empty($get_coupon['code'])?$get_coupon['code']:"" ?>"  placeholder="code" >
  </div>

  <div class="form-group">
    <label for="code">coupon type</label>
    <select class="form-control" name="coupon_type">
         <option >select</option>
         <?php
   
        if($get_coupon['coupon_type']==1){
            echo '<option value="1" selected>percentage</option>
            <option value="2">fixed</option>';
        }else if($get_coupon['coupon_type']==2){
            echo '<option value="1">percentage</option>
            <option value="2" selected>fixed</option>';
        }else{
            echo '<option value="1">percentage</option>
            <option value="2" >fixed</option>';
        }
         
         ?>
        
    </select>
   
  </div>

  <div class="form-group">
    <label for="discount">discount</label>
    <input type="text" class="form-control" id="discount" value="<?= !empty($get_coupon['discount'])?$get_coupon['discount']:"" ?>" name="discount" placeholder="discount" >
  </div>



  <div class="form-group">
    <label for="start">start	</label>
    <input type="date" class="form-control" id="start" name="start" value="<?= !empty($get_coupon['start'])?$get_coupon['start']:"" ?>" placeholder="start" >
  </div>


  <div class="form-group">
    <label for="end">end</label>
    <input type="date" class="form-control" id="end" name="end" value="<?= !empty($get_coupon['end'])?$get_coupon['end']:"" ?>" placeholder="end" >
  </div>

  <div class="form-group">
    <label for="min_cart">min cart</label>
    <input type="text" class="form-control" id="min_cart" name="min_cart"  value="<?= !empty($get_coupon['min_cart'])?$get_coupon['min_cart']:"" ?>"  placeholder="min cart" >
  </div>



 
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    </div>









          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->


        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include('./layouts/footer.php') ?>