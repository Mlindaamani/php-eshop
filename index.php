<?php
include('includes/header.php');
?>
<?php if (isset($_GET['success'])) { ?>
  <div class="alert alert-success alert-dismissible show text-center fw-bold container mt-3" role="alert">
    You have successfully signed up! Now you can explore more in Ebot!
    <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
  </div>
<?php } ?>

<?php if (isset($_GET['newitem'])) { ?>
  <div class="alert alert-success alert-dismissible show text-center fw-bold container mt-3" role="alert">
    Added To Cart!
    <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
  </div>
<?php } ?>
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