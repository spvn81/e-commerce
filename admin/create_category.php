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
<?php 
if(isset($_POST['submit'])){
include('config/conn.php');
$title = $_POST['title'];
$status = $_POST['status'];
$check_title = trim(strtolower($title));
$convert_to_slug_array = explode(' ',$check_title);
$slug = implode('-',$convert_to_slug_array);

$sql_insert_category = "INSERT INTO categories(title,slug,status)VALUES('$title','$slug',$status)";
mysqli_query($conn,$sql_insert_category);


}



?>
      
    <div class="col-md-12">
    <form method="post">

  <div class="form-group">
    <label for="title">title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="title">
  </div>


  <div class="form-group">
    <label for="status">status</label>
    <select class="form-control" name="status">
    <option value="">SELECT</option>
    <option value="1">Active</option>
    <option value="2">InActive</option>

    </select>
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