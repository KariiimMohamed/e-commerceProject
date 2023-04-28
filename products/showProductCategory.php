<?php include("../components/header.php") ?>

<?php 
    $row_id = $_POST['row_id']
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
                    <th scope="col">Product description</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Category Name</th>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
                    <th scope="col">EDIT category</th>
                    <th scope="col">DELETE category</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $conn = mysqli_connect("localhost" , "root" , "" , "e-commerce1");
                    $create_db = "CREATE DATABASE IF NOT EXISTS `e-commerce1`";
                    mysqli_query($conn , $create_db);

                    $request = "SELECT * FROM `products` INNER JOIN `categories` ON products.category_id = categories.id;";
                    $result = mysqli_query($conn , $request);
                    while ($row = mysqli_fetch_assoc($result) ):
                    if($row['id'] == $row_id):
                ?>     
                <tr>
                    <th scope="row"> <?= $row['product_id']; ?> </th>
                    <td> <?=  $row['product_name']; ?> </td>
                    <td> <?=  $row['product_description']; ?> </td>
                    <td>
                        <?php if (isset( $row['image_name'])): ?>
                        <img src= <?=$BASE_URL . 'handelars/productsHandelars/productImges/'. $row['image_name']?> width="30" height="30" class="d-inline-block align-top" alt=""> 
                        <?php else:?> <?= 'NO IMG' ?> <?php endif;?>
                    </td>
                    <td> <?=  $row['cat_name']; ?> </td>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
                    <form method="post" action="../category/editCat.php">
                        <td>
                            <button type="submit" name="row_id" value =" <?= $row['id'] ?> " class="btn btn-primary">Edit</button>
                        </td>
                    </form>
                    <form method="post" action="../handelars/categoryHandelars/delete.php">
                        <td>
                            <button type="submit" name="row_id" value =" <?= $row['id'] ?> " class="btn btn-primary">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endif; endif; endwhile; ?>
            </tbody>
</table>


<?php include("../components/footer.php") ?>