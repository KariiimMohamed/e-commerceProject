<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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


    function validate ($a){
        return trim(htmlspecialchars(htmlentities($a)));
    }

    //Sanitization

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $conpassword = validate($_POST['conpassword']);
    $role = validate($_POST['role']) ;
    $submit = validate($_POST['submit']);

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
 

 

    // first name Validation 
    if ( empty($fname) ) {
        $errors[] = 'Plz enter UR First Name';
    } else if (strlen($fname) <= 2 ) {
        $errors[] = ' UR Name should be more than 2 characters ';
    } else if (!ctype_alpha($fname)) {
         $errors[] = ' UR Name should be has no numbers, special sympols ';
    }

    // last name Validation 
    if ( empty($lname) ) {
        $errors[] = 'Plz enter UR Last Name'; 
    } else if (strlen($lname) <= 2 ) {
        $errors[] = 'UR Last Name should be more than 2 characters';
    } else if (!ctype_alpha($fname)) {
        $errors[] = ' UR Last Name should be has no numbers ';
    }

    // email Validation 
    if ( empty($email) ) {
        $errors[] = 'Plz enter UR E-mail';
    } else if (strlen($email) <= 14 ) {
        $errors[] = 'Plz enter UR right E-mail this is too short';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] =  "Email should be like example@example.com ";
    } 

    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
    $request = "SELECT * FROM `users`";
    $result = mysqli_query($conn , $request);
    $userFounded = false;
    while ($row = mysqli_fetch_assoc($result) ) {
        if ($row['email'] == $email) {
            $userFounded = true;
        }
    }

    if ($userFounded) {
        $errors[] =  "This email is already linked to an account ";
    }




    // password Validation 
    if ( empty($password) ) {
        $errors[] = 'Plz enter UR password';
    } else if (strlen($password) <= 6 ) {
        $errors[] = 'Plz enter a strong password more than 6 numbers';
    } else if ($password != $conpassword) {
        $errors[] = 'Confirmation is wrong plz try again';
    }

    // password confirmation Validation 
    if ( empty($conpassword) ) {
        $errors[] = 'Plz confirm UR password';
    } 

    // role Validation
    if ( empty($role) || $role == "nothing" ) {
        $errors[] = 'Plz Choose UR role';
    } elseif ($role != 'admin' && $role != 'user' ) {
        $errors[] = "Don't Play Here";
    }

    $_SESSION['role'] = $role;
        

 
    // submit Validation 
    if ( $submit != 'Sign up' ) {
        $errors[] = "PLZ DON'T PLAY";
    } 

  



    if (empty($errors)) {

        $insert_users_table = " INSERT INTO  `users` ( `first_name` , `last_name` , `email` , `password`, `role` , `image_name` ) VALUES (
        '$fname' , '$lname' , '$email' ,'$password'  , '$role' , '$new_image_name')";
        mysqli_query($conn , $insert_users_table);




        $_SESSION['signupSuccess'] = "U Signed up Successfully PLZ Login Now";
        header('location:../../registration/login.php');
        
    } else {
        $_SESSION['errors'] = $errors;
        header('location:../../registration/signup.php');
        
    }

    

    
 

}










?>