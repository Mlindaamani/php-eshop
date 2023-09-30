<?php
// Include header contents
include('includes/header.php');

//Include Prosuct class
include 'models/Product.php';

//Include database class.
include 'models/db.php';

//Create new instance of Produc class.
$product = new Product(new Database);
?>

<!-- Display a successfully message when a customer signs up -->
<?php if (isset($_GET['success'])) { ?>
  <div class="alert alert-success alert-dismissible show text-center fw-bold container mt-2" role="alert">
    You have successfully signed up! Now you can explore more in Ebot!
    <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
  </div>
<?php } ?>


<!-- Display a successfully message when the product is added in the database -->
<?php if (isset($_GET['newitem'])) { ?>
  <div class="alert alert-success alert-dismissible show text-center fw-bold container mt-2" role="alert">
    Added To Cart!
    <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
  </div>
<?php } ?>


<!-- Create a sidebar for the product listing UI-->
<!-- <div class="container-fluid bg-secondary-subtle mt-5">
  <div class='row'>
    <div class='col-md-2 bg-dark-subtle p-0 text-center rounded'>
      <ul class='navbar-nav me-auto'>
        <li class='nav-item '>
          <a href='#' class='nav-link text-light bg-primary rounded'>
            <h6>CATEGORIES</h6>
          </a>
        </li>
        <li class='nav-item '>
          <a href='' class='nav-link text-primary link-warning'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary link-underline-success'>Category 1</a>
        </li>
        <li class='nav-item'>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-light bg-primary'>
            <h6>BRANDS</h6>
          </a>
        </li>
        <li class='nav-item '>
          <a href='admin/dashboard.php' class='nav-link text-primary'>Dashboard</a>
        </li>
        <li class='nav-item '>
          <a href='admin/addproduct.php' class='nav-link text-primary'>Add Product</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-light bg-primary'>
            <h6>PROMOTIONS</h6>
          </a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
        <li class='nav-item '>
          <a href='#' class='nav-link text-primary'>Category 1</a>
        </li>
      </ul>
    </div> -->
<!-- Product Listing Section -->
<div class='col-md-12 rounded border shadow mt-5'>
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
<?php include 'includes/footer.php' ?>