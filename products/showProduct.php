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
                    <th scope="col">Product Name</th>
                    <th scope="col">Product price</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product description</th>
                    <?php if(isset($_SESSION['loginSuccess']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ):?>
                    <th scope="col">Category id</th>
                    <?php endif;?>
                    <?php if(isset($_SESSION['loginSuccess'])):?>
                    <th scope="col">Wishlist</th>
                    <th scope="col">BUY</th>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
                    <th scope="col">EDIT Product</th>
                    <th scope="col">DELETE Product</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php  

                    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
                    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
                    mysqli_query($conn , $create_db);

                    $request = "SELECT * FROM `products`";
                    $result = mysqli_query($conn , $request);
                    while ($row = mysqli_fetch_assoc($result) ):
        
                ?>     
                <tr>
                    <th scope="row"> <?= $row['product_id']; ?> </th>
                    <td> <?=  $row['product_name']; ?> </td>
                    <td> <?=  $row['product_price']; ?> </td>
                    <td>
                        <?php if (isset( $row['image_name'])): ?>
                        <img src= <?=$BASE_URL . 'handelars/productsHandelars/productImges/'. $row['image_name']?> width="30" height="30" class="d-inline-block align-top" alt=""> 
                        <?php else:?> <?= 'NO IMG' ?> <?php endif;?>
                    </td>
                        
                    </a>
                    <td> <?=  $row['product_description']; ?> </td>
                    <?php if(isset($_SESSION['loginSuccess']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ):?>

                    <td> <?=  $row['category_id']; ?> </td> 
                    <?php endif;?>
                    <?php if(isset($_SESSION['loginSuccess'])):?>
                    <td>
                        <form method="post" action="../handelars/productsHandelars/wishlist.php">
                            <button type="submit" name="row_id" value =" <?= $row['product_id'] ?> " class="btn btn-primary">ADD to Wishlist</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="../orders/addOrder.php">
                            <button type="submit" name="row_id" class="btn btn-primary">BUY</button>
                        </form>
                    </td>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
                    <td>
                        <form method="post" action="../products/editProduct.php">
                            <button type="submit" name="row_id" value =" <?= $row['product_id'] ?> " class="btn btn-primary">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="../handelars/productsHandelars/delete.php">
                            <button type="submit" name="row_id" value =" <?= $row['product_id'] ?> " class="btn btn-primary">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                <?php endif; endwhile; ?>
            </tbody>
</table>

<?php include("../components/footer.php") ?>