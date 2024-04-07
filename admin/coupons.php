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
            <a href="create_coupon.php"> <button class="btn  btn-success btn-lg">Create coupon</button></a>
            </div>
        <div class="col-md-12">

        <div class="card-body">
          <?php 
    include('config/conn.php');



        ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>title</th>
                      <th>description</th>
                      <th>code</th>
                      <th>coupon type</th>
                      <th>discount</th>
                      <th>start</th>
                      <th>end</th>
                      <th>min cart</th>

                    </tr>
                  </thead>
                  <tbody>
              
               
                  </tbody>
                </table>
              </div>
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