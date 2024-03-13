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
include('config/conn.php');
$id = $_GET['id'];
$sql_category_select = "SELECT * FROM categories WHERE id='$id'";
$category_ex = mysqli_query($conn,$sql_category_select);
$category_data = mysqli_fetch_assoc($category_ex);

if(isset($_POST['submit'])){
$title = $_POST['title'];
$status = $_POST['status'];
$check_title = trim(strtolower($title));
$convert_to_slug_array = explode(' ',$check_title);
$slug = implode('-',$convert_to_slug_array);

$sql_update_category ="UPDATE categories SET title='$title',slug='$slug',status='$status' WHERE id='$id'";
if(mysqli_query($conn,$sql_update_category)){
    echo "<script>
    window.location='categories.php';
  </script>";
}





}



?>
      
    <div class="col-md-12">
    <form method="post">

  <div class="form-group">
    <label for="title">title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="title" value="<?=$category_data['title'] ?>">
  </div>


  <div class="form-group">
    <label for="status">status</label>
    <select class="form-control" name="status">
    <option value="">SELECT</option>
    <?php
     $selected_active='';
     $selected_in_active='';
    if($category_data['status']==1){
        $selected_active = "selected";
    }else if($category_data['status']==2){
        $selected_in_active = "selected";

    }else{

    }
    
    ?>
    <option value="1" <?=$selected_active ?>>Active</option>
    <option value="2" <?= $selected_in_active ?>>InActive</option>

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