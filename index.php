<?php
require_once __DIR__ . "/config/config.php";
$title = HOME;
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . "/includes/functions.php";
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
  <div class="offcanvas offcanvas-start" data-bs-backdrop="false" tabindex="1" id="offcanvasScrolling">
    <div class="offcanvas-header bg-success text-light">
      <h5 class="offcanvas-title bg-success">
        <?= escapeChars(SIDE_BAR) ?>
      </h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <?php foreach ($category->categories() as $category): ?>
      <div class="offcanvas-body bg-success">
        <a class="offcanvas-list text-light text-decoration-none fw-bold" href="index.php">
          <?= escapeChars($category['category_name']) ?>
        </a>
      </div>
    <?php endforeach ?>
  </div>
</div>

<?php generateAlert('yes', 'Product already added in the cart', 'info'); ?>
<div class="container mt-5" style="margin-top:50px">
  <div class=" row g-5">
    <?php foreach ($product->products() as $product): ?>
      <div class="col-12 col-md-6 col-lg-4 mt-5">
        <div class="card border shadow custom-card-style">
          <div class="card-img rounded">
            <img src="admin/uploads/<?= escapeChars($product['image_url']) ?>" alt="Product">
          </div>
          <div class="card-body">
            <h5 class="card-title text-success fw-bold">
              <?= escapeChars($product['product_name']) ?>
            </h5>
            <p class="card-text lead">
              <?= escapeChars($product['description']) ?>
            </p>
            <p class="card-text lead fw-bold text-success">$
              <?= escapeChars($product['price']) ?>
            </p>
            <form action="cart/cart-handler.php" method="post">
              <input type="hidden" name="id" value="<?= escapeChars($product['id']) ?>" />
              <button type="submit" class="btn btn-success fw-bold" name="add">ADD TO CART</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php' ?>