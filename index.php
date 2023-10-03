<?php
// Include header contents
include('includes/header.php');
//Include Prosuct class
include 'models/Product.php';
//Include database class.
include 'models/Database.php';
//Create new instance of Produc class.
$product = new Product(new Database);
//Display a success message when user signs up successfully.
generateAlert('success', 'You have successfully signed up! Now you can explore more in Ebot!', 'success');
// Display a successfully message when the product is added in the database 
generateAlert('newitem', '  Added To Cart!', 'success');
?>


<div class="container-fluid bg-secondary-subtle">
  <div class='row'>
    <!-- Create a sidebar for the product listing UI-->
    <div class='col-md-2 bg-dark-subtle p-0 text-center'>
      <ul class='navbar-nav me-auto'>
        <li class='nav-item '>
          <a href='admin/dashboard.php' class='nav-link text-primary'>Dashboard</a>
        </li>
      </ul>
    </div>

    <!-- Product Listing Section -->
    <div class='col-md-10 rounded border shadow mt-5'>
      <div class="d-flex flex-wrap">
        <?php foreach ($product->getAllProducts() as $product) { ?>
          <!-- Loop through this column for all the product provided by getAllProducts() -->
          <div class='col-md-3'>
            <!-- Product Card Start-->
            <div class='card m-3 border shadow w-80 h-80'>
              <!-- Product Image -->
              <img src='admin/uploads/images/<?= $product['image_url'] ?>' class='card-img-top border shadow' />
              <!-- Cart Body -->
              <div class='card-body'>

                <!-- Product Name -->
                <h5 class='card-title'>
                  <?= $product['product_name'] ?>
                </h5>

                <!-- Product Description -->
                <p class='card-text lead'>
                  <?= $product['description'] ?>
                </p>

                <!-- Product Price -->
                <p class='text-end fw-bold lead'>
                  $
                  <?= $product['price'] ?>
                </p>

                <!-- Form to sent the request to the addd_to_cart page -->
                <form action="cart/add_to_cart.php" method="post">
                  <input type="hidden" name="id" value="<?= $product['id'] ?>" />
                  <input type="submit" class='btn btn-primary' value="ADD TO CART" name="add_to_cart" />
                </form>
              </div>
            </div>
            <!-- Product Card end-->
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php include "includes/footer.php" ?>