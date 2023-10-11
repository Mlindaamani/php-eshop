<!-- Shopping cart haeader -->
<div class="container mt-3 p-4 col-md-8">
  <h4 class="fw-bold text-center mb-3"> Your Shopping Cart</h4>
  <table class="table table-responsive  border shadow">
    <!-- Display the table header if products exits in the table -->
    <?php if ($CartItem->getItemsCount($userId) > 0 && isset($userId)): ?>
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
        <?php foreach ($CartItem->getAllCartItems($userId) as $product): ?>
          <tr>
            <td>
              <img src="../admin/uploads/images/<?= $product['product_image'] ?>" alt="Product Image" width="80"
                style="text-align: center" />
            </td>
            <td style="text-align:center" class=" my-5 ms-5 fw-bold lead">
              <?= $product['product_name'] ?>
            </td>
            <td style="text-align:center;color:green" class=" my-5 ms-5 fw-bold lead">$
              <?= $product['price'] ?>
            </td>
            <form action="updatecart.php" method="post">
              <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>" />
              <input type="hidden" name="cartItemId" value="<?= $product['id'] ?>" />
              <td style="text-align:center" class="custom">
                <input type="number" min="1" value="<?= $product['quantity'] ?>" class=" my-5 ms-5 p-2"
                  name="product_quantity" />
              </td>
              <td style="text-align:center; color:green;" class=" my-5 ms-5">$
                <?= number_format($product['total_price'], 2) ?>
              </td>
              <td>
                <button type="submit"
                  class="btn btn-link btn-primary text-light fw-bold text-decoration-none my-5 ms-5 bg-primary  border shadow"
                  name="update">UPDATE</button>
                <button type="submit" class="btn btn-link text-decoration-none text-light fw-bold bg-danger  border shadow"
                  name="remove"> REMOVE</button>
            </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <!-- Display the message when there no more products in the cart -->
      <?php else: ?>
        <div class="alert alert-success alert-dismissible  border shadow" role="alert">Your Ebot Cart is empty!
        </div>
      <?php endif; ?>
    </tbody>
  </table>
  <!-- Continue_shopping, subtotal and continue_shopping buttons -->
  <?php if ($CartItem->getItemsCount($userId) > 0 && isset($userId)): ?>
    <div class="text-center  border shadow p-2">
      <a href="../index.php" class="btn bg-primary fw-bold float-start text-light  border shadow">Continue Shopping</a>
      <button class="btn btn-primary-subtle  border shadow lead fw-bold">Subtotal:
        <span style="color:green; font-size:20px" class="fw-bold">$
          <?= number_format($CartItem->subTotal($userId), 2) ?>
        </span>
      </button>
      <a href="cart.php" class="btn btn-success float-end fw-bold  border shadow">Proceed to Checkout</a>
    </div>
  <?php endif; ?>
</div>