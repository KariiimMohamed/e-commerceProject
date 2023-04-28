<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"]  == "POST") {
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
        $errors = [];
        

   

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $row_id = validate($_POST['row_id']);
        $user_id = $_SESSION['user_id'];
        

        if (!is_numeric($row_id)) {
            $errors[] = "DON'T PLAY WITH DELETE";
        }

        $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
        $request = "SELECT * FROM `wishlist`";
        $result = mysqli_query($conn , $request);
        $productFounded = false;
        while ($row = mysqli_fetch_assoc($result) ) {
            if ($row['product_id'] == $row_id && $row['user_id'] = $user_id ) {
                $productFounded = true;
            }
        }

    if ($productFounded) {
        $errors[] =  "Product has been added before ";
    }
 


        if (empty($errors)) {
            


            $insert_wishlist_table = " INSERT INTO  `wishlist` ( product_id , user_id ) VALUES (
            '$row_id' , '$user_id')";
            mysqli_query($conn , $insert_wishlist_table);
            $_SESSION['success'] = "Added Successfully";
                        

           
             
        }  else {
            $_SESSION['erorrs'] = $errors;
        }
        header("location:../../products/showProduct.php");

    }
?>