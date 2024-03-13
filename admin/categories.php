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
            <a href="create_category.php"> <button class="btn  btn-success btn-lg">Create Category</button></a>
            </div>
        <div class="col-md-12">

        <div class="card-body">
          <?php 
    include('config/conn.php');
    $category_select ="SELECT * FROM categories";
    $category_ex = mysqli_query($conn,$category_select);
    $categories = mysqli_fetch_all($category_ex,MYSQLI_ASSOC);
    if(isset($_GET['delete_category_id'])){
      $delete_category_id = $_GET['delete_category_id'];
      $sql_category_delete = "DELETE FROM categories WHERE id='$delete_category_id'";
      if(mysqli_query($conn,$sql_category_delete)){
        echo "<script>window.location='categories.php'</script>";
      }

    }



        ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>title</th>
                      <th>slug</th>
                      <th>status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(   $categories as $category){ ?>
                    <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['title'] ?></td>
                    <td><?= $category['slug'] ?></td>
                    <td><?php 
                        if($category['status']==1){
                          echo "Active";
                        }else if($category['status']==2){
                          echo "In Active";

                        }else{
                          echo "Not set";

                        }
                    
                    
                    ?></td>
                    <td><a href="categories.php?delete_category_id=<?=$category['id'] ?>">delete</a>|
                    <a href="category_edit.php?id=<?=$category['id'] ?>">Edit</a></td>
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