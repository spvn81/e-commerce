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
            <a href="create_product.php"> <button class="btn  btn-success btn-lg">Create Product</button></a>
            </div>
        <div class="col-md-12">

        <div class="card-body">

        <?php 
include('config/conn.php');
$products_select_sql = "SELECT
 products.id,
 products.product_title,
 products.product_description,
 products.product_image,
 products.price,
 products.category_id,
 products.quantity_type,
 categories.title
 FROM products INNER JOIN  categories ON categories.id=products.category_id";
$product_ex  = mysqli_query($conn,$products_select_sql);
$products = mysqli_fetch_all($product_ex,MYSQLI_ASSOC);



if(isset($_GET['delete_product_id'])){
  $delete_product_id = $_GET['delete_product_id'];
  $delete_sql = "DELETE FROM products WHERE id='$delete_product_id'";
  if(mysqli_query($conn,$delete_sql)){
    echo "<script>window.location='products.php'</script>";
  }

}

?>
   
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>product title</th>
                      <th>product description</th>
                      <th>product image</th>
                      <th>price</th>
                      <th>category</th>
                      <th>quantity type</th>
                      <th>action</th>

                    </tr>
                  </thead>
                  <tbody>

      <?php foreach($products as $product){ ?>
                  <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['product_title'] ?></td>
                    <td><?= $product['product_description'] ?></td>
                    <td><img src="<?= $product['product_image'] ?>" width="150"></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['title'] ?></td>
                    <td><?php
                      if($product['quantity_type']==1){
                        echo "KG";
                      }else{
                        echo "Not set";
                      }
                    
                    
                    ?></td>
                    <td><a href="edit_products.php?id=<?=$product['id'] ?>">Edit</a>|
                    <a href="products.php?delete_product_id=<?=$product['id'] ?>">Delete</a></td>
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