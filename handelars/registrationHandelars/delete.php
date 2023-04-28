<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {

        $errors = [];
        

   

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $row_id = validate($_POST['row_id']);
        

        if (!is_numeric($row_id)) {
            $errors[] = "DON'T PLAY WITH DELETE";
        }

 

        if (empty($errors)) {
            $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
            $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
            mysqli_query($conn , $create_db);

            $updateChild = "UPDATE `orders` SET `user_id` = NULL WHERE `user_id` = '$row_id' ";
            mysqli_query($conn , $updateChild);

            $updateWish = "UPDATE `wishlist` SET `user_id` = NULL WHERE `user_id` = '$row_id' ";
            mysqli_query($conn , $updateWish);

            $delete_row = "DELETE FROM `users` WHERE `id` = '$row_id' ";
            mysqli_query($conn , $delete_row);
            $_SESSION['success'] = "user deleted Successfuly";

            
        }  else {
            $_SESSION['erorrs'] = $errors;
        }
        header("location:../../registration/showUsers.php");

    }

    






?>