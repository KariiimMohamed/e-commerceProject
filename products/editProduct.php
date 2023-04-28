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
        
            $request = "SELECT * FROM `products` WHERE `product_id` = $row_id  ";
            $result = mysqli_query( $conn , $request );
            $data = mysqli_fetch_assoc($result);
            $_SESSION['product_id'] = $row_id;
        } else {
            $_SESSION['erorrs'] = $errors;
            header("location:./showProduct.php");
        }

        
    }

?>

<div class="container mt-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
                <form action="../handelars/productsHandelars/edit.php" method="post">
					<div class="form-group mb-2">
						<label for="exampleFormControlInput1">EDIT product</label>
						<input type="text" class="form-control" name="edited-product" id="exampleFormControlInput1"
                         value="<?php echo htmlspecialchars($data['product_name']); ?>">

						<input type="text" class="form-control" name="edited-product_price" id="exampleFormControlInput1"
                         value="<?php echo htmlspecialchars($data['product_price']); ?>" placeholder="Add new price">

						<input type="text" class="form-control" name="edited-product_description" id="exampleFormControlInput1"
                         value="<?php echo htmlspecialchars($data['product_description']); ?>" placeholder="Add new description">
					</div>
					<button  type="submit" name="add" class="btn btn-primary">EDIT</button>
				</form>
			</div>
		</div>
</div>


<?php include("../components/footer.php"); ?> 