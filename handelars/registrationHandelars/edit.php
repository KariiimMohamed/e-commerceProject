<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {


        $errors = [];
        $success = [];

        $userId = $_SESSION['user_id'];

        

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $new_first_name= validate($_POST['edited-first_name']);
        $new_last_name= validate($_POST['edited-last_name']);
        $new_password= validate($_POST['edited-password']);

        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_size = $image['size'];
        $image_type = $image['type'];
        $image_tmp_name = $image['tmp_name'];
        $image_error = $image['error'];

        $ext = pathinfo($image_name);
        $image_extension = $ext['extension'];

        //image validate
        $allowed = ["jpg" , "png" , "jpeg"];
        if (!empty($image_name)) {
            if (in_array($image_extension , $allowed)) {

                if ($image_error == 0) {
    
                    if($image_size < 10000000) {
                        $new_image_name = uniqid('' , true).$image_name;
                        $image_destination = "userImages/". $new_image_name;
                        move_uploaded_file($image_tmp_name , $image_destination);
                    } else {
                        $errors[] = "Image Size is too big";
                    }
                    
                } else {
                    $errors[] = "plz choose a valid img";
                }
                
            } else {
                $errors[] = "plz choose image as jpg , png or jpeg";
            }
            $_SESSION['image_name'] = $new_image_name;
        }

    
        
        
        if ( empty($new_first_name) ) {
            $errors[] = 'Plz enter UR First Name';
        } else if (strlen($new_first_name) <= 2 ) {
            $errors[] = ' UR Name should be more than 2 characters ';
        } else if (!ctype_alpha($new_first_name)) {
             $errors[] = ' UR Name should be has no numbers, special sympols ';
        }

        if ( empty($new_last_name) ) {
            $errors[] = 'Plz enter UR Last Name'; 
        } else if (strlen($new_last_name) <= 2 ) {
            $errors[] = 'UR Last Name should be more than 2 characters';
        } else if (!ctype_alpha($new_last_name)) {
            $errors[] = ' UR Last Name should be has no numbers ';
        }

        if ( empty($new_password) ) {
            $errors[] = 'Plz enter UR password';
        } else if (strlen($new_password) <= 6 ) {
            $errors[] = 'Plz enter a strong password more than 6 numbers';
        }


        if (empty($errors)) {
            $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
            $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
            mysqli_query($conn , $create_db);

            $edit_product = "UPDATE `users` SET `first_name` = '$new_first_name' , `last_name` = '$new_last_name' , `password` = '$new_password' 
             WHERE
                `id` = $userId  " ;
            mysqli_query($conn , $edit_product);

            if(!empty($new_image_name)) {
                $edit_product = "UPDATE `users` SET `image_name`= '$new_image_name'
                WHERE
                `id` = $userId  " ;
                 mysqli_query($conn , $edit_product);
            }
            $_SESSION['success'] = "Account uploaded Successfuly";
 
            
        } else {
            $_SESSION['erorrs'] = $errors;
        }
        
        header("location:../../products/showProduct.php");
    }

     






?>