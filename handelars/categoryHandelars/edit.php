<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {


        $errors = [];
        $success = [];

        $cat_id = $_SESSION['cat_id'];

         

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $new_cat_name= validate($_POST['edited-category']);
        

        if (empty($new_cat_name)) {
            $errors[] = "PLZ ENTER CATEGOREY NAME";
        } else if (strlen($new_cat_name) <= 2 ) {
            $errors[] = ' UR category should be more than 3 characters ';
        } else if (strlen($new_cat_name) > 30 ) {
            $errors[] = " UR category should't be more than 30 characters ";
        }

        if (empty($errors)) {
            $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
            $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
            mysqli_query($conn , $create_db);

            $edit_category = "UPDATE `categories` SET `cat_name` = '$new_cat_name' WHERE `id` = $cat_id  ";
            mysqli_query($conn , $edit_category);
            $_SESSION['success'] = "category uploaded Successfuly";

            
        } else {
            $_SESSION['erorrs'] = $errors;
        }
        
        header("location:../../category/showCat.php");
    }

    






?>