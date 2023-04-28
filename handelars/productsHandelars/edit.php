<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {


        $errors = [];
        $success = [];

        $product_id = $_SESSION['product_id'];
        

        

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $new_product_name= validate($_POST['edited-product']);
        $new_product_price= validate($_POST['edited-product_price']);
        $new_product_description= validate($_POST['edited-product_description']);
        

        if (empty($new_product_name)) {
            $errors[] = "PLZ ENTER PRODUCT NAME";
        } else if (strlen($new_product_name) <= 2 ) {
            $errors[] = ' UR PRODUCT should be more than 3 characters ';
        } else if (strlen($new_product_name) > 30 ) {
            $errors[] = " UR PRODUCT should't be more than 30 characters ";
        }

        if (empty($errors)) {
            $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
            $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
            mysqli_query($conn , $create_db);

            $edit_product = "UPDATE `products` SET `product_name` = '$new_product_name' , `product_price` = '$new_product_price' , `product_description` = '$new_product_description'
             WHERE
                `product_id` = $product_id  " ;
            mysqli_query($conn , $edit_product);
            $_SESSION['success'] = "product uploaded Successfuly";

            
        } else {
            $_SESSION['erorrs'] = $errors;
        }
        
        header("location:../../products/showProduct.php");
    }

     






?>