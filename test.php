<div class='col-md-12 rounded'>
  <div class="d-flex flex-wrap">
    <?php $res = mysqli_query($con, "SELECT * FROM products ORDER BY RAND()");
    while ($row = mysqli_fetch_assoc($res)) { ?>
      <div class='col-md-3'>
        <div class='card m-3'>
          <img src='admin/uploads/images/<?= $row['image_url'] ?>' class='card-img-top' />
          <div class='card-body' style='width: 18rem;'>
            <h5 class='card-title'>
              <?= $row['product_name'] ?>
            </h5>
            <p class='card-text'>
              <?= $row['description'] ?>
            </p>
            <p class='text-end fw-bold'>
              $
              <?= $row['price'] ?>
            </p>
            <form action="cart/add_to_cart.php" method="post">
              <input type="hidden" name="id" value="<?= $row['id'] ?>" />
              <input type="submit" class='btn btn-primary' value="ADD TO CART" name="add_to_cart" />
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
</div>
</div>
<?php include 'includes/footer.php' ?>