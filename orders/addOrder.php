 
<?php include("../components/header.php") ?>
<?php $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
    $request = "SELECT * FROM `products`";
    $result = mysqli_query($conn , $request);


?>


    <div class="container mt-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
                <form action="../handelars/ordersHandelars/add.php" method="post">
					<div class="form-group mb-2">
						<label for="exampleFormControlInput1">ADD Order</label>
						<input type="text" class="form-control mb-2" name="order" id="exampleFormControlInput1" placeholder="Add name">
						<input type="text" class="form-control" name="orderAddress" id="exampleFormControlInput1" placeholder="Add address">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="product">
                                <option selected value="nothing">Choose UR Product</option>
                                <?php while ($row = mysqli_fetch_assoc($result) ): ?>
                                <option value= '<?= $row['product_id'] ?>'> <?= $row['product_name']; ?> </option>
                                <?php endwhile; ?>
                            </select>
                            <label for="floatingSelect">Works with selects</label>
                        </div>
					</div> 
					<button type="submit" name="add" class="btn btn-primary">ADD</button>
				</form>
			</div>
		</div>

        <?php 
            if (!empty($_SESSION['errors'])):
            foreach ($_SESSION['errors'] as $error) :
        ?>      

            <div class="col-md-3 alert alert-primary " role="alert"  >
                <?php echo $error ?>
            </div>

        <?php
                endforeach;
                unset($_SESSION['errors']);
                endif;       
        ?>

        <?php if (isset( $_SESSION['success'] )): ?>
            <div class="col-md-3 alert alert-primary " role="alert"  >

                <?php echo $_SESSION['success'] ; ?>

            </div>
        <?php unset($_SESSION['success']); endif; ?>
        

      
	</div>



<?php include("../components/footer.php") ?>