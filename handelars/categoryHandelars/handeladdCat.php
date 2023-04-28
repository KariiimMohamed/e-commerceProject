<?php 

    session_start();
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
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

        $errors = [];

        function validate($x) {
            return trim(htmlspecialchars ( htmlentities($x) ) );
        }    

        $category = validate($_POST['category']);
        $add = validate($_POST['add']);

        if ( empty($category) ) {
            $errors[] = 'Plz enter UR category';
        } else if (strlen($category) <= 2 ) {
            $errors[] = ' UR category should be more than 3 characters ';
        } else if (strlen($category) > 30 ) {
            $errors[] = " UR category should't be more than 30 characters ";
        } else if (is_numeric($category)) {
            $errors[] = " Invalid category ";
        }




        if ( !empty($errors) ) { 

            $_SESSION['errors'] = $errors; 

        } else {

            $_SESSION['success'] = "category Added Successfuly";


            

            // // INSERT DATA
            $insert_categories_table = " INSERT INTO  `categories` ( cat_name ) VALUES (
            '$category')";
            mysqli_query($conn , $insert_categories_table);
            






        }
 
        header("location:../../category/addCat.php");

       


    }







?>