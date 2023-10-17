<?php
// Start session if not started.
@session_start();
//Disable unnessary error reporting
error_reporting(0);
//Include the header contents.
include '../includes/header.php';
//Create new instance of CartItem
$CartItem = new CartItem(new Database);
//Get userId from the session variable(super global)
$userId = $_SESSION['user_id'];
?>

<!-- Issue an error message when the entered Quantity is greater than the available Quantity -->
<div>
  <?php generateAlert('stock', ' No Enough stock Quantity for the entered Quantity!', 'danger') ?>
</div>
<div class="container mt-3 p-4 col-md-8">
  <h4 class="fw-bold text-center mb-3"> Your Shopping Cart</h4>
  <div class="table-responsive">
    <table class="table border shadow">
      <?php if ($CartItem->getItemsCount($userId) > 0 && isset($userId)): ?>
        <thead>
          <tr class="mt-5">
            <th class="bg-primary text-light text-center">IMAGE</th>
            <th class="bg-primary text-light text-center">NAME</th>
            <th class="bg-primary text-light text-center">PRICE</th>
            <th class="bg-primary text-light text-center">QUANTITY</th>
            <th class="bg-primary text-light text-center">TOTAL PRICE</th>
            <th class="bg-primary text-light text-center">REMOVE</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop through all the cartItems products and display them on the table for a auth_user. -->
          <?php foreach ($CartItem->getAllCartItems($userId) as $product): ?>
            <tr>
              <td class="text-center mt-3">
                <img src="../uploads/<?= $product['product_image'] ?>" alt="Product Image" width="80" />
              </td>

              <td class="text-center mt-3">
                <?= $product['product_name'] ?>
              </td>

              <td class="text-center mt-3" style="color:green">$
                <?= $product['price'] ?>
              </td>

              <td class="text-center mt-3">
                <form action="updatecart.php" method="post" class="d-flex justify-content-center align-items-center">
                  <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>" />
                  <input type="hidden" name="cartItem_id" value="<?= $product['id'] ?>" />
                  <input type="number" min="1" value="<?= $product['quantity'] ?>" class="p-2 mr-2 mx-2"
                    name="product_quantity" />
                  <button type="submit" class="btn text-light btn-primary border shadow mx-2" name="update">UPDATE</button>
              </td>

              <td class="text-center mt-3" style="color:green">$
                <?= number_format($product['total_price'], 2) ?>
              </td>

              <td class=" text-center mt-3">
                <button type="submit" class="btn text-light btn-danger border shadow mx-2" name="remove">
                  REMOVE</button>
              </td>
              </form>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-success alert-dismissible  border shadow" role="alert">Your Ebot Cart is empty!
          </div>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($CartItem->getItemsCount($userId) > 0 && isset($userId)): ?>
    <div class="row justify-content-center mt-4">
      <div class="col-md-3 col-sm-12 mb-3">
        <a href="../index.php" class="btn btn-primary fw-bold text-light">Continue Shopping</a>
      </div>
      <div class="col-md-3 col-sm-12 mb-3 text-center">
        <button class="btn btn-primary-subtle fw-bold">
          Total Amount: <span style="color:green; font-size:20px" class="fw-bold">$
            <?= number_format($CartItem->subTotal($userId), 2) ?>
          </span>
        </button>
      </div>
      <div class="col-md-3 col-sm-12 mb-3">
        <a href="cart.php" class="btn btn-success fw-bold w-100">Proceed to Checkout</a>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php include "../includes/script.php" ?>