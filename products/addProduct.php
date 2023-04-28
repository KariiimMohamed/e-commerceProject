
<?php include("../components/header.php") ?>


    <div class="container mt-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
                <form action="../handelars/productsHandelars/add.php" method="post" enctype="multipart/form-data">
					<div class="form-group mb-2">
						<label for="exampleFormControlInput1">ADD product</label>
						<input type="text" class="form-control mb-2" name="product" id="exampleFormControlInput1" placeholder="Product Name">
						<input type="number" class="form-control mb-2" name=" price" id="exampleFormControlInput1" placeholder="Product price">
                        
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Product photo</label>
                            <input class="form-control" type="file" id="formFile" name="image">       
                        </div>
                        
						<div class="form-floating">
                            <?php $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
                                $request = "SELECT * FROM `categories`";
                                $result = mysqli_query($conn , $request);
                              
                            ?>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="categoryId">
                                <option selected value="nothing">Choose Category</option>
                                <?php while ($row = mysqli_fetch_assoc($result) ): ?>
                                <option value= '<?= $row['id'] ?>'> <?= $row['cat_name']; ?> </option>
                                <?php endwhile; ?>
                            </select>
                            <label for="floatingSelect">Works with selects</label>
                        </div>
						<input type="text" class="form-control mb-2" name="description" id="exampleFormControlInput1" placeholder="Product decription">
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