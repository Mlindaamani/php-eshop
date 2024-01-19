<?php
@session_start();
error_reporting(0);
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";
$title = CART;
require_once __DIR__ . '/../includes/header.php';
?>

<div>
  <?php generateAlert('stock', ' No Enough Stock Quantity for the entered Quantity!', 'danger') ?>
  <?php generateAlert('check-out', 'Thank you for trading with Ebot. Your order on the way!', 'success') ?>
</div>

<div class="container mt-3 p-4 col-md-8">
  <h4 class="fw-bold text-center mb-3">
    <?= $user->authUser(User::id()) ?>'s Shopping Cart
  </h4>
  <div class="table-responsive">
    <table class="table border shadow">
      <?php if (!$cartitem->isCartItemEmpty()): ?>
        <tr class="mt-5">
          <th class="bg-success text-light text-center">IMAGE</th>
          <th class="bg-success text-light text-center">NAME</th>
          <th class="bg-success text-light text-center">PRICE</th>
          <th class="bg-success text-light text-center">QUANTITY</th>
          <th class="bg-success text-light text-center">TOTAL PRICE</th>
          <th class="bg-success text-light text-center">REMOVE</th>
        </tr>

        <tbody>
          <?php foreach ($cartitem->cartItems(User::id()) as $item): ?>
            <tr>
              <td class="text-center mt-3">
                <img src="../admin/uploads/<?= $item['product_image'] ?>" alt="Product Image" width="80" />
              </td>

              <td class="text-center mt-3 text-success fw-bold">
                <?= $item['product_name'] ?>
              </td>

              <td class="text-center mt-3 text-success fw-bold">$
                <?= $item['price'] ?>
              </td>

              <td class="text-center mt-3">
                <form action="update-cart.php" method="post" class="d-flex justify-content-center align-items-center">
                  <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>" />
                  <input type="hidden" name="cartItem_id" value="<?= $item['id'] ?>" />
                  <input type="number" min="1" value="<?= $item['quantity'] ?>" class="p-2 mr-2 mx-2"
                    name="product_quantity" />
                  <button type="submit" class="btn text-light btn-primary border shadow mx-2" name="update">UPDATE</button>
              </td>

              <td class="text-center mt-3 text-success fw-bold">$
                <?= number_format($item['total_price'], DEFAULT_DECIMAL_NUMBER) ?>
              </td>

              <td class=" text-center mt-3">
                <button type="submit" class="btn text-light btn-danger border shadow mx-2 " name="remove">
                  REMOVE</button>
              </td>
              </form>
            </tr>
          <?php endforeach ?>
        <?php else: ?>
          <div class="alert alert-success alert-dismissible  border shadow" role="alert">Your Ebot Cart is empty!
          </div>
        <?php endif ?>
      </tbody>
    </table>
  </div>

  <?php if (!$cartitem->isCartItemEmpty()): ?>
    <div class="row justify-content-center mt-4">
      <div class="col-md-3 col-sm-12 mb-3 text-center">
        <button class="btn btn-primary-subtle fw-bold"> SUBTOTAL: <span class="fw-bold text-success">$
            <?= number_format($cartitem->subTotal(User::id()), DEFAULT_DECIMAL_NUMBER) ?>
          </span>
        </button>
      </div>
      <form action="check-out-handler.php" method="post">
        <input type="hidden" name="cartId" value="<?= $item['cart_id'] ?>">
        <div class="col-md-12">
          <button type="submit" class="btn btn-success fw-bold w-100 p-2" name="check-out"
            style="font-size: 30px;">Proceed to Checkout</button>
        </div>
      </form>
    </div>
  <?php endif ?>
</div>
<?php require_once __DIR__ . "/../includes/script.php" ?>