 <?php include ('../components/header.php') ?>


    <div class="container" >
        <form class="row g-3 needs-validation b-"  action="../handelars/registrationHandelars/handelSignup.php" method="post" novalidate enctype="multipart/form-data">

            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationCustom01" value="" name="fname" required>
            
            </div>
 
            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" value="" name="lname" required>
            </div>

            <div class="col-md-4">
                <label for="validationCustomUsername" class="form-label">E-mail</label>
                <div class="input-group has-validation">
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                </div>
            </div>
 
            <div class="col-md-4">
                <label for="validationCustom03" class="form-label">Password</label>
                <input type="password" class="form-control" id="validationCustom03" name="password" required>
            </div>

            <div class="col-md-4">
                <label for="validationCustom03" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="validationCustom03" name="conpassword" required>
            </div>

            <div class="form-floating">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="role">
                    <option selected value="nothing">Choose UR Role</option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
                <label for="floatingSelect">Works with selects</label>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Upload your photo</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>

        
            <div class="col-12">
                <input class="btn btn-primary" value="Sign up" type="submit" name="submit">
            </div>

        </form>
        
        <div class="mt-5">
            <?php 
                if( !empty($_SESSION['errors']) ):
                foreach ($_SESSION['errors'] as $error ): 
            ?>
                <div class="col-md-3 alert alert-primary " role="alert"  >
                    <?php echo $error ?>
                </div>
            <?php
                endforeach;
                unset($_SESSION['errors']);
                endif;  
            ?>

        </div>

     
    </div>


    <?php include ('../components/footer.php') ?>
