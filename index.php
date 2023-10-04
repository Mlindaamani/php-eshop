<?php
// Include header contents
include('includes/header.php');
error_reporting(0);
//Include Prosuct class
include 'models/Product.php';
//Include Prosuct class
include 'models/CartItem.php';
//Include database class.
include 'models/Database.php';
//Create new instance of Produc class.
$product = new Product(new Database);
$cartItem = new CartItem(new Database);
//Display a success message when user signs up successfully.
generateAlert('success', 'You have successfully signed up! Now you can explore more in Ebot!', 'success');
// Display a successfully message when the product is added in the database 
generateAlert('newitem', '  Added To Cart!', 'success');
?>

<div class="container-fluid bg-secondary-subtle">
  <div class='row'>
    <div class="container bg-primary text-end">
      <span style="font-size: 17px; color: #fff;" class="text-light fw-bold bg-danger p-1 rounded p-2 badge my-3">
        <?= $cartItem->getItemsCount($_SESSION['user_id']) ?>
      </span>
    </div>
    <!-- Create a sidebar for the product listing UI-->
    <div class='col-md-2 bg-dark-subtle p-0 text-center'>
      <ul class='navbar-nav me-auto'>
        <li class='nav-item '>
          <a href='admin/dashboard.php' class='nav-link text-primary'>Dashboard</a>
        </li>
      </ul>
    </div>

    <div class='col-md-10 rounded border shadow mt-5'>
      <?= generateAlert('yes', 'Product already present in the cartItems', 'info'); ?>
      <div class="d-flex flex-wrap">
        <?php foreach ($product->getAllProducts() as $product): ?>
          <div class='col-md-3'>
            <div class='card m-3 border shadow col-md-10'>
              <img src='admin/uploads/images/<?= $product['image_url'] ?>' class='card-img-top border shadow' />
              <div class='card-body'>
                <h5 class='card-title'>
                  <?= $product['product_name'] ?>
                </h5>
                <p class='card-text lead'>
                  <?= $product['description'] ?>
                </p>
                <p class='text-end fw-bold lead'>$
                  <?= $product['price'] ?>
                </p>
                <form action="cart/add_to_cart.php" method="post">
                  <input type="hidden" name="id" value="<?= $product['id'] ?>" />
                  <input type="submit" class='btn btn-primary' value="ADD TO CART" name="add_to_cart" />
                </form>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
<?php include "includes/footer.php" ?>