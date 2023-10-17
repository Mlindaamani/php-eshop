<?php
// Include header contents
include('includes/header.php');

// Disable the error reporting for unset user_id
error_reporting(0);

//Create new instance of Product class.
$product = new Product(new Database);

//Create new instance of CartItem class.
$cartItem = new CartItem(new Database);

//Display a success message when user signs up successfully.
generateAlert('success', 'You have successfully signed up! Now you can explore more in Ebot!', 'success');
?>

<!-- Create a sidebar for the product listing UI-->
<div class='p-0 text-center' style="width:100px">
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
    id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header bg-primary-subtle text-light">
      <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Ebot</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body bg-primary">
      <p>Categories.</p>
    </div>
  </div>
</div>

<!-- Didplay the message when the product is already added in the cart -->
<?php generateAlert('yes', 'Product already added in the cart', 'info'); ?>
<div class="container mt-5" style="margin-top:50px">
  <div class=" row g-5">
    <?php foreach ($product->getAllProducts() as $product): ?>
      <div class="col-12 col-md-6 col-lg-4 mt-5">
        <div class="card border shadow custom-card-style">
          <div class="card-img rounded">
            <img src="uploads/<?= $product['image_url'] ?>" alt="">
          </div>
          <div class="card-body">
            <h5 class="card-title">
              <?= $product['product_name'] ?>
            </h5>
            <p class="card-text lead">
              <?= $product['description'] ?>
            </p>
            <p class="card-text lead fw-bold" style="color: green;">$
              <?= $product['price'] ?>
            </p>
            <form action="cart/cart_handler.php" method="post">
              <input type="hidden" name="id" value="<?= $product['id'] ?>">
              <button type="submit" class="btn btn-primary text-bottom" name="add">ADD TO CART</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php include "includes/footer.php" ?>