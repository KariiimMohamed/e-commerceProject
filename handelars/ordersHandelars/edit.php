<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {


        $errors = [];
        $success = []; 

        $order_id = $_SESSION['order_id'];

         

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $new_order_name= validate($_POST['edited_order']);
        $new_order_address= validate($_POST['edited_order_address']);
        

        if (empty($new_order_name)) {
            $errors[] = "PLZ ENTER OREDER NAME";
        } else if (strlen($new_order_name) <= 2 ) {
            $errors[] = ' UR OREDER should be more than 3 characters ';
        } else if (strlen($new_order_name) > 30 ) {
            $errors[] = " UR OREDER should't be more than 30 characters ";
        }

        if (empty($new_order_address)) {
            $errors[] = "PLZ ENTER OREDER ADDRESS";
        } else if (strlen($new_order_address) <= 10 ) {
            $errors[] = ' UR OREDER should be more than 10 characters ';
        }

        if (empty($errors)) {
            $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
            $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
            mysqli_query($conn , $create_db);

            $edit_order = "UPDATE `orders` SET `order_name` = '$new_order_name' , `order_address` = '$new_order_address' WHERE `id` = $order_id  ";
            mysqli_query($conn , $edit_order);
            $_SESSION['success'] = "Order uploaded Successfuly";

            
        } else {
            $_SESSION['erorrs'] = $errors;
        }
        
        header("location:../../orders/showOrder.php");
    }

    






?>