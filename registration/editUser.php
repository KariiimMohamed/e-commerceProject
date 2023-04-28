<?php include("../components/header.php") ?>
<?php

   

    if ($_SERVER["REQUEST_METHOD"]  == "POST") {

        $errors = [];

   

        function validate($var) {
            return trim(htmlspecialchars(htmlentities($var)));
        }

        $row_id = validate($_POST['row_id']);
        
 
        if (!is_numeric($row_id)) {
            $errors[] = "DON'T PLAY HERE";
        }
 

        if (empty($errors)) {
            $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
            $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
            mysqli_query($conn , $create_db);
        
            $request = "SELECT * FROM `users` WHERE `id` = $row_id  ";
            $result = mysqli_query( $conn , $request );
            $data = mysqli_fetch_assoc($result);
            $_SESSION['product_id'] = $row_id;
        } else {
            $_SESSION['erorrs'] = $errors;
        }

        
    }

?>

<div class="container mt-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
                <form action="../handelars/registrationHandelars/edit.php" method="post" enctype="multipart/form-data">
					<div class="form-group mb-2">
						<label for="exampleFormControlInput1">EDIT UR account</label>
						<input type="text" class="form-control" name="edited-first_name" id="exampleFormControlInput1"
                         value="<?php echo htmlspecialchars($data['first_name']); ?>" placeholder="New first name">
						<input type="text" class="form-control" name="edited-last_name" id="exampleFormControlInput1"
                         value="<?php echo htmlspecialchars($data['last_name']); ?>" placeholder="New last name">
						<input type="text" class="form-control" name="edited-password" id="exampleFormControlInput1"
                         value="<?php echo htmlspecialchars($data['password']); ?>" placeholder="New password">

                        <div class="mt-1 mb-1">
                            <label for="formFile" class="form-label">Upload your photo</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>

						
					</div>
					<button  type="submit" name="add" class="btn btn-primary">EDIT</button>
				</form>
			</div>
		</div>
</div>


<?php include("../components/footer.php"); ?> 