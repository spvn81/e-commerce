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


function getProductById($conn,$product_id){
    $sql_products = "SELECT * FROM products WHERE id='$product_id'";
    $product_ex = mysqli_query($conn,$sql_products);
    $products_fetch = mysqli_fetch_assoc($product_ex);
    return $products_fetch;


}

function getSubtotalByCartId($conn,$cart_id){
    $sql_sum_cart_items = "SELECT SUM(total_price)  as total_price FROM cart_items WHERE cart_id='$cart_id'";
    $sql_sum_cart_items_ex = mysqli_query($conn,$sql_sum_cart_items);
    $sql_sum_cart_items_fetch = mysqli_fetch_assoc($sql_sum_cart_items_ex);
    return $sql_sum_cart_items_fetch['total_price'];

}

function getCartItemsCountByCartId($conn,$cart_id){
    $cart_items_count_sql = "SELECT COUNT(product_id) as cart_count FROM cart_items WHERE cart_id='$cart_id'";
    $cart_items_count_ex = mysqli_query($conn,$cart_items_count_sql);
    $cart_items_count_fetch = mysqli_fetch_assoc($cart_items_count_ex);
    if(!empty($cart_items_count_fetch['cart_count'])){
        return $cart_items_count_fetch['cart_count'];

    }else{
        return 0;
    }



}

function getUser($conn){
    $user_id = $_SESSION['user_id'];
    $get_user_sql = "SELECT * FROM users WHERE id='$user_id'";
    $get_user_ex = mysqli_query($conn,$get_user_sql);
    $get_user_fetch = mysqli_fetch_assoc($get_user_ex);
    return $get_user_fetch;

}

function getCartIdByUser($conn,$user_id){
    $get_cart_id_sql = "SELECT id FROM cart WHERE user_id='$user_id'";
    $get_cart_id_ex = mysqli_query($conn,$get_cart_id_sql);
    $get_cart_id_fetch = mysqli_fetch_assoc($get_cart_id_ex);
    if(!empty($get_cart_id_fetch['id'])){
        return $get_cart_id_fetch['id'];

    }else{
        return;
    }
}




?>