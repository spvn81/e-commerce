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
    $products_sql_get = "SELECT * FROM  products WHERE id = '$id'";
    $product_ex = mysqli_query($conn,$products_sql_get);
    $product = mysqli_fetch_assoc($product_ex);

    $categories_sql = "SELECT * FROM categories";
    $categories_ex = mysqli_query($conn,$categories_sql);
    $category_data = mysqli_fetch_all($categories_ex,MYSQLI_ASSOC);

    if(isset($_POST['submit'])){
        if(!empty($_FILES['product_image']['tmp_name'])){
            $image_file = $_FILES['product_image']['tmp_name'];
            $target_file = 'files/'.$_FILES['product_image']['name'];
            move_uploaded_file($image_file,$target_file);
            $product_image = $target_file;

        }else{
            $product_image = $product['product_image'];
        }
        

        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $price = $_POST['price'];
        $category_id  = $_POST['category_id'];
        $quantity_type = $_POST['quantity_type'];
        $update_product = "UPDATE products SET
         product_title='$product_title',
          product_description='$product_description',
          product_image='$product_image',
          price='$price',
          category_id='$category_id',
          quantity_type='$quantity_type'
          
          ";
        
        
        if(mysqli_query($conn,$update_product)){
          echo "  <script>
          window.location='products.php';
        </script>";
        }



    }





?>

    <form method="post" enctype= multipart/form-data>

  <div class="form-group">
    <label for="title">product title</label>
    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="product title" value="<?= $product['product_title'] ?>">
  </div>

  <div class="form-group">
    <label for="title">product description</label>
    <textarea  class="form-control"  id="product_description" name="product_description"  ><?= $product['product_description'] ?></textarea>
  </div>

  <div class="form-group">
    <label for="title">product image</label>
    <input type="file" class="form-control" id="product_image" name="product_image" >
    <?php if(!empty($product['product_image'])){?>
        <img src="<?= $product['product_image'] ?>" width="100">

  <?php   } ?>

  </div>
  <div class="form-group">
    <label for="price">price</label>
    <input type="text" class="form-control" id="price" name="price" placeholder="price" value="<?= $product['price'] ?>">
  </div>


  <div class="form-group">
    <label for="category_id">category id </label>
    <select name="category_id" class="form-control" id="category_id">
    <option value="">SELECT</option>

        <?php foreach($category_data as $category){?>
                <?php
                $selected_category = '';
                    if( $product['category_id']==$category['id']){
                        $selected_category='selected';
                    }
                    
                    ?>
            <option  <?=$selected_category ?> value="<?= $category['id'] ?>"><?= $category['title'] ?></option>


      <?php   } ?>
    </select>
  
  </div>


  <div class="form-group">
 



    <label for="quantity_type">quantity type</label>
    <select name="quantity_type" class="form-control" id="quantity_type">
        <option value="">SELECT</option>
        <?php
        $selected_kg ='';
            if($product['quantity_type']==1){
                $selected_kg ='selected';
            }
        
        ?>
        <option value="1" <?= $selected_kg ?>>KG</option>
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