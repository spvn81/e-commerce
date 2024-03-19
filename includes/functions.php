<?php

function getCategories($conn){
    $categories_sql = "SELECT * FROM categories";
    $categories_ex = mysqli_query($conn,$categories_sql);
    $categories_fetch = mysqli_fetch_all($categories_ex,MYSQLI_ASSOC);
    return $categories_fetch;
}

function getProducts($conn,$category_id=''){
    if(!empty($category_id)){
        $products_sql = "SELECT *  FROM products WHERE category_id='$category_id'";
        $products_ex = mysqli_query($conn,$products_sql);
        $products_fetch = mysqli_fetch_all($products_ex,MYSQLI_ASSOC);
    }else{
        $products_sql = "SELECT
        products.id,
        products.product_title,
        products.product_description,
        products.product_image,
        products.price,
        products.category_id,
        products.quantity_type,
        categories.title,
        categories.slug
        FROM products INNER JOIN categories ON categories.id=products.category_id";
        $products_ex = mysqli_query($conn,$products_sql);
        $products_fetch = mysqli_fetch_all($products_ex,MYSQLI_ASSOC);
    }

    return $products_fetch;
   


}



?>