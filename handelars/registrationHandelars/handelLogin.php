<?php 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    function validate ($a){
        return trim(htmlspecialchars(htmlentities($a)));
    }
 
    //Sanitization
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

 
     // email Validation 
    if ( empty($email) ) {
        $errors[] = 'Plz enter UR E-mail';
    } else if (strlen($email) <= 14 ) {
        $errors[] = 'Plz enter UR right E-mail this is too short';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] =  "Email should be like example@example.com ";
    } 

    // password Validation 
    if ( empty($password) ) {
        $errors[] = 'Plz enter UR password';
    } else if (strlen($password) <= 6 ) {
        $errors[] = 'Plz enter a strong password more than 6 numbers';
    }

    if ( empty($errors) ) {


        $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");

        $request = "SELECT * FROM `users`";
        $result = mysqli_query($conn , $request);
        $userFounded = false;
        while ($row = mysqli_fetch_assoc($result) ) {
            if ($row['email'] == $email && $row['password'] == $password) {
                $userFounded = true;
                
                //to show user name in header
                $_SESSION['user_name'] = $row['first_name'];

                //to show user name in header 
                $_SESSION['image_name'] = $row['image_name'];

                //to show delete button to admin
                $_SESSION['role'] = $row['role'];
                
                //to catch user id
                $_SESSION['user_id'] = $row['id']; 

            }  
        }





        if ($userFounded) {
            $_SESSION['loginSuccess'] = "U Logged in Successfully PLZ Enter UR Task";            

            header("location:../../products/showProduct.php");
        } else {
            $_SESSION['errors'][] = "The email address isn't connected to an account or Password was wrong Plz try again";
            header("location:../../registration/login.php");
        }

    } else {
        $_SESSION['errors'] = $errors;
        header("location:../../registration/login.php");
    }


} 


?>