<?php $BASE_URL = "http://127.0.0.1/g-313/projects/e-commerce1/"; ?> 
<?php session_start(); ?>

<!doctype html>
<html lang="en"> 
  <head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kariim Store</title>
    <link rel="icon" type="image/png" href="https://ih1.redbubble.net/image.284215326.6088/flat,750x,075,f-pad,750x1000,f8f8f8.jpg"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


              <?php if(isset($_SESSION['loginSuccess'])):?>
              <a class="navbar-brand" href="#">
                <img src= <?=$BASE_URL . 'handelars/registrationHandelars/userImages/'. $_SESSION['image_name']?> width="30" height="30" class="d-inline-block align-top" alt="">
              </a>
              <?php endif; ?>

              <li class="nav-item">
                <a class="nav-link " href = <?=$BASE_URL?>>
                  <?php if(isset($_SESSION['user_name'] )) {
                    echo $_SESSION['user_name'];
                  } else {
                    echo 'HOME' ;
                  } ?> 
                </a>
              </li>
              
              <?php if(!isset($_SESSION['loginSuccess'])):?>
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."registration/signup.php"?> >Sign up</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."registration/login.php"?>>Login</a>
              </li>
              <?php endif; ?>

              



              
              <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."category/addCat.php"?>>ADD category</a>
              </li>
              <?php endif; ?>

              <?php if(isset($_SESSION['loginSuccess'])):?>
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."category/showCat.php"?>>categories</a>
              </li>
              <?php endif; ?>


              <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
              <li class="nav-item">
              <a class="nav-link" href = <?=$BASE_URL."products/addProduct.php"?>>ADD Product</a>
              </li>
              <?php endif; ?>

              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."products/showProduct.php"?>>Products</a>
              </li>
              
              <?php if(isset($_SESSION['loginSuccess'])):?> 
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."products/wishlist.php"?>>Wishlist</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."orders/addOrder.php"?>>ADD Order</a>
              </li>
              <?php endif; ?>              

              <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>  
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."orders/showOrder.php"?>>Orders</a>
              </li>
              <?php endif; ?>


              <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && isset($_SESSION['loginSuccess'])): ?>
                <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."registration/showUsers.php"?>>Users</a>
              </li>
              <?php endif; ?>              
              
              <?php if(isset($_SESSION['loginSuccess'])):?>
              <li class="nav-item">
                <a class="nav-link" href = <?=$BASE_URL."registration/logout.php"?>>Logout</a>
              </li>

              <form method="post" action= <?=$BASE_URL."registration/editUser.php"?> >
                <td>
                    <button type="submit" name="row_id" value =" <?= $_SESSION['user_id'] ?> " class="btn btn-primary">Edit Profile</button>
                </td>
              </form>
              <?php endif; ?>



              
            </ul>

            </div>
        </div>
    </nav>