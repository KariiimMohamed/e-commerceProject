<?php 

    session_start();
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");

        $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
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

        if(!mysqli_query($conn , $create_products_table) ) {
            mysqli_connect_error();
        }

        $errors = [];
 
        function validate($x) {
            return trim(htmlspecialchars ( htmlentities($x) ) );
        }    

        $product = validate($_POST['product']);
        $price = validate($_POST['price']);
        $description = validate($_POST['description']);
        $categoryId = validate($_POST['categoryId']);
        $add = validate($_POST['add']); 

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
        if (in_array($image_extension , $allowed)) {

            if ($image_error == 0) {

                if($image_size < 10000000) {
                    $new_image_name = uniqid('' , true).$image_name;
                    $image_destination = "productImges/". $new_image_name;
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

        if ( empty($product) ) {
            $errors[] = 'Plz enter UR Product';
        } else if (strlen($product) <= 2 ) {
            $errors[] = ' UR Product should be more than 3 characters ';
        } else if (strlen($product) > 30 ) {
            $errors[] = " UR Product should't be more than 30 characters ";
        }

        if ( empty($price) ) {
            $errors[] = 'Plz enter UR Product price';
        } else if (!is_numeric($price) || $price <= 0) {
            $errors[] = ' Invalid price ';
        }
        


        if ( empty($description) ) {
            $errors[] = 'Plz enter UR Product description';
        } else if (is_numeric($description)) {
            $errors[] = ' Invalid description ';
        } else if (strlen($description) < 10 ) {
            $errors[] = 'Description is not enough, please make it more than 10 characters';
        }

        if (!is_numeric($categoryId)) {
            $errors[] = ' Invalid category Id ';
        } elseif ($categoryId == 'nothing') {
            $errors[] = 'PLZ choose category';
        }
        $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
        $request = "SELECT * FROM `categories`";
        $result = mysqli_query($conn , $request);
        $idExists = false;
        while ($row = mysqli_fetch_assoc($result) ){
            if($row['id'] == $categoryId) {
                $idExists = true;
            }
        }

        if(!$idExists) {
            $errors[] = 'category Id is not exists';
        }





        if ( !empty($errors) ) { 

            $_SESSION['errors'] = $errors; 

        } else {

            $_SESSION['success'] = "product Added Successfuly";


            

            // // INSERT DATA
            $insert_products_table = " INSERT INTO  `products` ( product_name , product_price , product_description , category_id , image_name ) VALUES (
            '$product' , '$price' , '$description' , '$categoryId' , '$new_image_name' )";
            mysqli_query($conn , $insert_products_table);
            

 




        }
 
        header("location:../../products/addProduct.php");

       


    }







?>