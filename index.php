<?php
require_once __DIR__ . "/config/app-config.php";

$title = HOME;

require_once __DIR__ . '/includes/header.php';

error_reporting(0);

$product = new Product(new Database);

$cartItem = new CartItem(new Database);

$category = new Category(new Database);

$user = new User(new Database);


generateAlert('success', 'You have successfully signed up! Now you can explore more in Ebot!', 'success');
generateAlert('guest', 'You are now browsing as guest!', 'success');
?>

<!-- Create a sidebar for the product listing UI-->
<div class='p-0 text-center' style="width:100px">
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
    id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header bg-primary-subtle text-light">
      <h5 class="offcanvas-title" id="offcanvasScrollingLabel bg-primary">
        <?= SIDE_BAR ?>
      </h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <?php foreach ($category->getAllCategories() as $category): ?>
      <div class="offcanvas-body bg-primary">
        <ul class="offcanvas-list">
          <?= $category['category_name'] ?>
        </ul>
      </div>
    <?php endforeach ?>
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
            <form action="cart/cart-handler.php" method="post">
              <input type="hidden" name="id" value="<?= $product['id'] ?>">
              <button type="submit" class="btn btn-primary text-bottom" name="add">ADD TO CART</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php' ?>