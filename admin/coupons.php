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

    $get_coupons = "SELECT * FROM coupons";
    $get_coupons_ex = mysqli_query($conn,$get_coupons);
    $get_coupons_data = mysqli_fetch_all($get_coupons_ex,MYSQLI_ASSOC);
    if(!empty($_GET['delete_id'])){
      $delete_id = $_GET['delete_id'];
      $delete_coupon = "DELETE FROM coupons WHERE id='$delete_id'";
      if(mysqli_query($conn,$delete_coupon)){
        echo "<script>
        window.location='coupons.php';
      </script>";
      }
    }



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
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
            <?php foreach($get_coupons_data as $get_coupon){ ?>
                  <tr>
                    <td><?= $get_coupon['id'] ?></td>
                    <td><?= $get_coupon['title'] ?></td>
                    <td><?= $get_coupon['description'] ?></td>
                    <td><?= $get_coupon['code'] ?></td>
                    <td><?= $get_coupon['coupon_type'] ?></td>
                    <td><?= $get_coupon['discount'] ?></td>
                    <td><?= $get_coupon['start'] ?></td>
                    <td><?= $get_coupon['end'] ?></td>
                    <td><?= $get_coupon['min_cart'] ?></td>
                    <td><a href="edit_coupon.php?id=<?= $get_coupon['id'] ?>">Edit</a>|<a href="?delete_id=<?= $get_coupon['id'] ?>">Delete</a></td>

                
                  </tr>
                  <?php } ?>
              
               
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