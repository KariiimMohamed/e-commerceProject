 <?php include("../components/header.php") ?>

<?php if(isset($_SESSION['erorrs'])):
      foreach( $_SESSION['erorrs'] as $error ): ?>

<div class="alert alert-danger"><?= $error ?></div>

<?php endforeach;
 unset($_SESSION['erorrs']);
      endif;  ?>

<?php if (isset( $_SESSION['success'] )): ?>
    <div class="alert alert-danger ">

        <?php echo $_SESSION['success'] ; ?>

    </div>
<?php unset($_SESSION['success']); endif; ?> 
<table class="table">
            <thead>
                <tr> 
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User E-mail</th>
                    <th scope="col">User Password</th>
                    <th scope="col">User Role</th>
                    <th scope="col">DELETE User</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
                    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
                    mysqli_query($conn , $create_db);

                    $request = "SELECT * FROM `users`";
                    $result = mysqli_query($conn , $request);
                    while ($row = mysqli_fetch_assoc($result) ):
        
                ?>     
                <tr>
                    <th scope="row"> <?= $row['id']; ?> </th>
                    <td> <?=  $row['first_name']." ".$row['last_name']; ?> </td>
                    <td> <?=  $row['email']; ?> </td>
                    <td> <?=  $row['password']; ?> </td>
                    <td> <?=  $row['role']; ?> </td>
                    <form method="post" action="../handelars/registrationHandelars/delete.php">
                        <td>
                            <button type="submit" name="row_id" value =" <?= $row['id'] ?> " class="btn btn-primary">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endwhile; ?>
            </tbody>
</table> 

<?php include("../components/footer.php") ?>