<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'e-commerce1';

$conn = mysqli_connect($host, $username, $password);
$sql = 'CREATE DATABASE IF NOT EXISTS `e-commerce1`';
mysqli_query($conn, $sql);
$conn = mysqli_connect($host, $username, $password , $database );







function user_table() {

    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
    mysqli_query($conn , $create_db);

    $create_users_table = "CREATE TABLE IF NOT EXISTS `users` (
        `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `first_name` VARCHAR(30), 
        `last_name` VARCHAR(30), 
        `email` VARCHAR(50), 
        `password` VARCHAR(50),
        `image_name` TEXT,
        `role` VARCHAR (10) 
        
    )";
    mysqli_query($conn , $create_users_table);

}

function category_table() {
    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");

    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
    mysqli_query($conn , $create_db);


    $create_categories_table = "CREATE TABLE IF NOT EXISTS `categories` (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        cat_name VARCHAR(30) 
    )";

    if(!mysqli_query($conn , $create_categories_table) ) {
        mysqli_connect_error();
    }
}


function products_table() {
    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
    mysqli_query($conn , $create_db);


    $create_products_table = "CREATE TABLE IF NOT EXISTS `products` (
        product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        product_name VARCHAR(30),
        product_price INT NOT NULL,
        product_description TEXT,
        image_name TEXT,
        category_id INT ,
        FOREIGN KEY (category_id) REFERENCES categories(id)

    )";

    mysqli_query($conn , $create_products_table);
}


function order_table() {
    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");

    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
    mysqli_query($conn , $create_db);


    $create_orders_table = "CREATE TABLE IF NOT EXISTS `orders` (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        order_name VARCHAR(30) ,
        order_address VARCHAR(200) ,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    mysqli_query($conn , $create_orders_table);

    $create_products_orders_table = "CREATE TABLE IF NOT EXISTS `products_orders` (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        order_id INT ,
        product_id INT ,
        user_id INT,
        FOREIGN KEY (order_id) REFERENCES orders(id),
        FOREIGN KEY (product_id) REFERENCES products(product_id)

    )";
    mysqli_query($conn , $create_products_orders_table);
}

function wishlist_table() {
    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
    mysqli_query($conn , $create_db);
    
    $create_wishlist_table = "CREATE TABLE IF NOT EXISTS `wishlist` (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        product_id INT,
        FOREIGN KEY (product_id) REFERENCES products(product_id),
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id)
    
    )";
    mysqli_query($conn , $create_wishlist_table);
}



function create_database() {
    user_table();
    category_table();
    products_table();
    order_table();
    wishlist_table();
}

?>