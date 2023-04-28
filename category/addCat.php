
<?php include("../components/header.php") ?>


    <div class="container mt-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
                <form action="../handelars/categoryHandelars/handeladdCat.php" method="post">
					<div class="form-group mb-2">
						<label for="exampleFormControlInput1">ADD category</label>
						<input type="text" class="form-control" name="category" id="exampleFormControlInput1">
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