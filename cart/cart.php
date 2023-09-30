<?php

// Start session if not started.
@session_start();

//Include the header contents.
include '../includes/header.php';

//Include Database class contents.
include '../models/db.php';

//Include the contents of CartsItems class and instantiate the CartItem class.
include '../models/CartItem.php';

//Create Cartitem objects(instances)
$CartItem = new CartItem(new Database);

//Retrieve user_id from the session data.
$userId = $_SESSION['user_id'];
?>

<!-- Shopping cart haeader -->
<div class="container mt-3 bg-secondary-subtle p-4">
  <h4 class="fw-bold text-center mb-3">Shopping Cart</h4>
  <table class="table table-responsive">

    <!-- Display the table header if products exits in the table -->
    <?php if ($CartItem->getItemsCount($userId) > 0 && isset($userId)) { ?>
      <thead>
        <tr>
          <th style="text-align:center" class="bg-primary text-light">IMAGE</th>
          <th style="text-align:center" class="bg-primary text-light">NAME</th>
          <th style="text-align:center" class="bg-primary text-light">PRICE</th>
          <th style="text-align:center" class="bg-primary text-light">QUANTITY</th>
          <th style="text-align:center" class="bg-primary text-light">TOTAL PRICE</th>
          <th class="table-actions bg-primary text-light" style="text-align:center" colspan="3">UPDATE/REMOVE
          </th>
        </tr>
      </thead>

      <!-- Shopping cart Body -->
      <tbody>
        <!-- PRODUCT DATA -->
        <?php foreach ($CartItem->getAllCartItems($userId) as $product) { ?>
          <tr>
            <!-- Product_Image -->
            <td>
              <img src="../admin/uploads/images/<?= $product['product_image'] ?>" alt="Product Image" width="80"
                style="text-align: center" />
            </td>

            <!-- Product_Name -->
            <td style="text-align:center" class=" my-5 ms-5">
              <?= $product['product_name'] ?>
            </td>

            <!-- Product_Price -->
            <td style="text-align:center" class=" my-5 ms-5">$
              <?= $product['price'] ?>
            </td>

            <form action="" method="post">
              <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>" />

              <td style="text-align:center" class="custom">
                <input type="number" min="1" value="<?= $product['quantity'] ?>" class=" my-5 ms-5 "
                  name="product_quantity" />
              </td>

              <!-- Cart Total price -->
              <td style="text-align:center" class=" my-5 ms-5 ">
                <?= $product['total_price'] ?>
              </td>

              <!-- Update and Remove buttons -->
              <td>
                <button type="submit"
                  class="btn btn-link btn-primary text-light fw-bold text-decoration-none my-5 ms-5 bg-primary"
                  name="update">UPDATE</button>
                <button type="submit" class="btn btn-link text-decoration-none text-light fw-bold bg-danger" name="remove">
                  REMOVE</button>
            </form>
            </td>
          </tr>
        <?php }

    } else {
      echo '<div class="alert alert-success alert-dismissible  show" role="alert">Your Ebot Cart is empty!</div>';
    } ?>
    </tbody>
  </table>


  <!-- Remove bottom buttons when the cart is empty! -->
  <?php if ($CartItem->getItemsCount($userId) > 0 && isset($userId)) { ?>
    <div class="text-center">
      <a href="../index.php" class="btn bg-primary fw-bold float-start text-light">Continue Shopping</a>
      <!-- Display subtotal -->
      <a class="btn btn-primary fw-bold">Subtotal: $
        <?= $CartItem->subTotal($userId) ?>
      </a>
      <a href="check_out.php" class="btn btn-success float-end fw-bold">Proceed to Checkout</a>
    </div>
  <?php } ?>
</div>

<?php
if (isset($_POST['update'])) {
  $updatedProductQuantity = $_POST['product_quantity'];
  $product_id = $_POST['product_id'];
  $CartItem->updateProductQuantity($updatedProductQuantity, $product_id, $userId);
}

if (isset($_POST['remove'])) {
  $productId = $_POST['product_id'];
  $CartItem->removeCartItem($productId);
}
?>