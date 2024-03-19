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
    $categories_sql = "SELECT * FROM categories";
    $categories_ex = mysqli_query($conn,$categories_sql);
    $category_data = mysqli_fetch_all($categories_ex,MYSQLI_ASSOC);

    if(isset($_POST['submit'])){

        $image_file = $_FILES['product_image']['tmp_name'];
        $target_file = 'files/'.$_FILES['product_image']['name'];
        move_uploaded_file($image_file,$target_file);
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_image = $target_file;
        $price = $_POST['price'];
        $category_id  = $_POST['category_id'];
        $quantity_type = $_POST['quantity_type'];
          $insert_product = "INSERT INTO products (product_title,product_description,product_image,price,category_id,quantity_type)
          VALUES('$product_title','$product_description','$product_image','$price','$category_id','$quantity_type')";
        if(mysqli_query($conn,$insert_product)){
          echo "  <script>
          window.location='products.php';
        </script>";
        }



    }





?>

    <form method="post" enctype= multipart/form-data>

  <div class="form-group">
    <label for="title">product title</label>
    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="product title">
  </div>

  <div class="form-group">
    <label for="title">product description</label>
    <textarea  class="form-control"  id="product_description" name="product_description"  ></textarea>
  </div>

  <div class="form-group">
    <label for="title">product image</label>
    <input type="file" class="form-control" id="product_image" name="product_image" >
  </div>
  <div class="form-group">
    <label for="price">price</label>
    <input type="text" class="form-control" id="price" name="price" placeholder="price" >
  </div>


  <div class="form-group">
    <label for="category_id">category id </label>
    <select name="category_id" class="form-control" id="category_id">
    <option value="">SELECT</option>

        <?php foreach($category_data as $category){?>

            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>


      <?php   } ?>
    </select>
  
  </div>


  <div class="form-group">
 



    <label for="quantity_type">quantity type</label>
    <select name="quantity_type" class="form-control" id="quantity_type">
        <option value="">SELECT</option>
        <option value="1">KG</option>
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