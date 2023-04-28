<?php 
include("./components/header.php");
require_once './databse/database.php'
?>
<?php



create_database();


$request1 = "SELECT * FROM `products`";
$result1 = mysqli_query($conn , $request1); 

$request2 = "SELECT count(`products_orders`.`product_id`) AS count , `products`.`product_id`FROM `products` LEFT JOIN `products_orders` ON `products`.`product_id` = `products_orders`.`product_id` GROUP BY `products_orders`.`product_id` ORDER BY count DESC LIMIT 3;";
$result2 = mysqli_query($conn , $request2);

?>
<div class="container mt-5"> 
        <h1 class="display-4">WELCOME TO MY STORE</h1>
        <hr>
        <div class="container">
                <h2 class="display-6">Three best selling products</h2>
                <div class="row">
                        <?php while ($topSalesRow = mysqli_fetch_assoc($result2)): ?>
                                <?php
                                $request = "SELECT * FROM `products` WHERE product_id = ".$topSalesRow['product_id'];
                                $result = mysqli_query($conn , $request);
                                ?>
                                        <?php while ($productRow = mysqli_fetch_assoc($result)): ?>
                                        <div class="col-md-3">
                                                <div class="card">                                       
                                                        <div class="card-body">
                                                                <?php if (isset( $productRow['image_name'])): ?>
                                                                <img src= <?=$BASE_URL . 'handelars/productsHandelars/productImges/'. $productRow['image_name']?>  class="card-img-top" alt=""> 
                                                                <?php else:?> <?= '<h4>NO IMG</h4>' ?> <?php endif;?>
                                                                <h5 class="card-title"><?= $productRow['product_name'] ?></h5>
                                                                <p class="card-text"><?= $productRow['product_description'] ?></p>
                                                                <?php if(isset($_SESSION['loginSuccess'])):?>
                                                                <a href= <?=$BASE_URL."orders/addOrder.php"?> class="btn btn-primary">Buy Now</a>
                                                                <?php endif; ?>
                                                        </div>
                                                </div>
                                        </div>
                                <?php endwhile; ?>
                        <?php endwhile; ?> 
                        </div>
                 </div>
        </div>

</div> 

<?php include("./components/footer.php")  ?> 