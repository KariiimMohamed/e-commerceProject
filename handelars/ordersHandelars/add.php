<?php 

    session_start();
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
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
        if(!mysqli_query($conn , $create_orders_table) ) {
            mysqli_connect_error();
        }

        $create_products_orders_table = "CREATE TABLE IF NOT EXISTS `products_orders` (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            order_id INT ,
            product_id INT ,
            user_id INT,
            FOREIGN KEY (order_id) REFERENCES orders(id),
            FOREIGN KEY (product_id) REFERENCES products(id)

        )";
        mysqli_query($conn , $create_products_orders_table);

        $errors = [];

        function validate($x) {
            return trim(htmlspecialchars ( htmlentities($x) ) );
        }    

        $order = validate($_POST['order']);
        $orderAddress = validate($_POST['orderAddress']);
        $productId = validate($_POST['product']);
        $add = validate($_POST['add']);

        if ( empty($order) ) {
            $errors[] = 'Plz enter UR Order';
        } else if (strlen($order) <= 2 ) {
            $errors[] = ' UR Order should be more than 3 characters ';
        } else if (strlen($order) > 30 ) {
            $errors[] = " UR Order should't be more than 30 characters ";
        }

        if ( empty($orderAddress) ) {
            $errors[] = 'Plz enter UR Address';
        } else if (strlen($orderAddress) <= 10 ) {
            $errors[] = ' UR Address should be more than 10 characters ';
        } 

        if ( empty($productId) ) {
            $errors[] = 'Plz Choose UR product';
        } else if (!is_numeric($productId)) {
            $errors[] = ' PLZ Choose a product ';
        } 




        if ( !empty($errors) ) { 

            $_SESSION['errors'] = $errors; 

        } else {

            $_SESSION['success'] = "Order Added Successfuly";


           

            

            
            $userID = $_SESSION['user_id']; 
            // INSERT DATA
            $insert_orders_table = " INSERT INTO  `orders` ( order_name , order_address  , user_id ) VALUES (
            '$order' , '$orderAddress', '$userID' )";
            mysqli_query($conn , $insert_orders_table );
            
            //get order id
            $last_id = mysqli_insert_id($conn);

            $insert_products_orders_table = " INSERT INTO  `products_orders` ( order_id , product_id  ) VALUES (
            '$last_id' , '$productId')";
            mysqli_query($conn , $insert_products_orders_table);
            
            
            
            
            
            
            
        }
 
        header("location:../../orders/addOrder.php");

       


    }







?>