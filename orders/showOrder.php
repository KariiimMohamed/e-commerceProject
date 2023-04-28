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
                    <th scope="col">order Name</th>
                    <th scope="col">order address</th>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
                    <th scope="col">EDIT order</th>
                    <th scope="col">DELETE order</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
                    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
                    mysqli_query($conn , $create_db);

                    $request = "SELECT * FROM `orders`";
                    $result = mysqli_query($conn , $request);
                    while ($row = mysqli_fetch_assoc($result) ):
        
                ?>     
                <tr>
                    <th scope="row"> <?= $row['id']; ?> </th>
                    <td> <?=  $row['order_name']; ?> </td>
                    <td> <?=  $row['order_address']; ?> </td>

                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
                    <form method="post" action="../orders/editOrder.php">
                        <td>
                            <button type="submit" name="row_id" value =" <?= $row['id'] ?> " class="btn btn-primary">Edit</button>
                        </td> 
                    </form>
                    <form method="post" action="../handelars/ordersHandelars/delete.php">
                        <td>
                            <button type="submit" name="row_id" value =" <?= $row['id'] ?> " class="btn btn-primary">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endif; endwhile; ?>
            </tbody>
</table>

<?php include("../components/footer.php") ?>