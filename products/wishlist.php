<?php include("../components/header.php") ?>

<?php
$conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");

$create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
mysqli_query($conn , $create_db);
$conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");


$request1 = "SELECT * FROM `products`";
$result1 = mysqli_query($conn , $request1);

$request2 = "SELECT * FROM `wishlist`  WHERE user_id = '".$_SESSION['user_id']."'";
$result2 = mysqli_query($conn , $request2);
?> 



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
                    <th scope="col">Product Name</th>
                    <th scope="col">Product price</th>
                    <th scope="col">Product description</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">BUY</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php  

                    while ($wishlist = mysqli_fetch_assoc($result2)): 

                        $request = "SELECT * FROM  `products` WHERE product_id = '".$wishlist['product_id']."'";
                        $result = mysqli_query($conn , $request);                        
                        while ($productRow = mysqli_fetch_assoc($result)): 

                ?>     
                    <tr>
                        <th scope="row"> <?= $productRow['product_id']; ?> </th>
                        <td> <?=  $productRow['product_name']; ?> </td>
                        <td> <?=  $productRow['product_price']; ?> </td>
                        <td>
                            <?php if (isset( $productRow['image_name'])): ?>
                            <img src= <?=$BASE_URL . 'handelars/productsHandelars/productImges/'. $productRow['image_name']?> width="30" height="30" class="d-inline-block align-top" alt=""> 
                            <?php else:?> <?= 'NO IMG' ?> <?php endif;?>
                        </td>
                        
                        <td> <?=  $productRow['product_description']; ?> </td>
                        <td>
                            <form method="post" action="../orders/addOrder.php">
                                <button type="submit" name="row_id" class="btn btn-primary">BUY</button>
                            </form>
                        </td>
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <td>
                            <form method="post" action="../handelars/productsHandelars/deleteWishlist.php">
                                <button type="submit" name="row_id" class="btn btn-primary" value="<?= $productRow['product_id'];?>">Delete</button>
                            </form>
                        </td>
                        <?php endif; ?>

                            
                    </tr>
                <?php endwhile; ?>
                <?php endwhile; ?>
            </tbody>
</table>

<?php include("../components/footer.php") ?>