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
 

    if(isset($_POST['submit'])){

      


    }





?>

    <form method="post" enctype= multipart/form-data>

  <div class="form-group">
    <label for="title"> title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder=" title">
  </div>

  <div class="form-group">
    <label for="title"> description</label>
    <textarea  class="form-control"  id="description" name="description"  ></textarea>
  </div>

 
  <div class="form-group">
    <label for="code">code</label>
    <input type="text" class="form-control" id="code" name="code" placeholder="code" >
  </div>

  <div class="form-group">
    <label for="code">coupon type</label>
    <select class="form-control" name="coupon_type">
        <option>percentage</option>
        <option>fixed</option>
    </select>
   
  </div>

  <div class="form-group">
    <label for="discount">discount</label>
    <input type="text" class="form-control" id="discount" name="discount" placeholder="discount" >
  </div>



  <div class="form-group">
    <label for="start">start	</label>
    <input type="date" class="form-control" id="start" name="start" placeholder="start" >
  </div>


  <div class="form-group">
    <label for="end">end</label>
    <input type="date" class="form-control" id="end" name="end" placeholder="end" >
  </div>

  <div class="form-group">
    <label for="min_cart">min cart</label>
    <input type="text" class="form-control" id="min_cart" name="min cart" placeholder="min cart" >
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