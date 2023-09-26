<?php include('../includes/header.php');
$con = dbconnect() ?>
<div class='row'>
  <!-- Sidebar -->
  <div class='col-md-2'>
    <?php include '../includes/sidepanel.php'; ?>
  </div>

  <div class='col-md-10'>
    <div class='container d-flex justify-content-center align-items-center mt-3 mb-3'>
      <form action='' method='post' class='border shadow p-3 rounded w-50' enctype='multipart/form-data'>
        <div class='mb-3'>
          <h5 class='text-center p-3'>Add Products</h5>

          <?php if (isset($_GET['added'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Product inserted Successfully!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><button>
            </div>
          <?php } ?>

          <?php if (isset($_GET['prod'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Product Already Present!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php } ?>

          <label class='form-label'>Enter product name</label>
          <input type='text' name='product_name' class='form-control' required>
        </div>
        <div class='mb-3'>
          <label for='lastname' class='form-label'>Enter Product Description</label>
          <input type='text' name='pro_description' class='form-control' required>
        </div>
        <div class='mb-3'>
          <label class='form-label'>Enter Product Price</label>
          <input type='number' name='product_price' class='form-control' step='0.01' required>
        </div>
        <div class='mb-3'>
          <label class='form-label'>Enter Stock Quantity</label>
          <input type='number' name='stock_quantity' class='form-control' required>
        </div>
        <div class='mb-3'>
          <label class='form-label'>Enter Product Image</label>
          <input type='file' name='product_image' class='form-control'>
        </div>

        <div class='mb-3'>
          <select name='category_id' class='form-select mb-3 custom-select p-4 bg-primary' required
            style='cursor:pointer' name='product_category' size="3">
            <?php $result = mysqli_query($con, 'SELECT * FROM categories');
            while ($data = mysqli_fetch_assoc($result)) { ?>
              <option value='<?= $data['id'] ?>' class='p-3 text-light custom-select' size='5'><?= $data['category_name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class='mb-3'>
          <button type='submit' class='btn btn-primary w-100 mb-2' name='submit'>Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php '../includes/footer.php' ?>
<?php
if (isset($_POST['submit'])) {

  $product_name = $_POST['product_name'];

  $product_description = $_POST['pro_description'];

  $product_price = $_POST['product_price'];

  $stock_quantity = $_POST['stock_quantity'];

  $product_image = $_FILES['product_image']['name'];

  $product_temp_name = $_FILES['product_image']['tmp_name'];

  $product_category = $_POST['product_category'];
  //Obtain the full path of the image directory.
  $admin_image_dir_path = realpath(__DIR__) . '/uploads/images/';

  $sql_results = mysqli_query($con, "SELECT image_url, product_name FROM products WHERE product_name=' $product_name' OR image_url = '$product_image'");

  $number_rows = mysqli_num_rows($sql_results);

  if ($number_rows > 0) {
    header('Location: addproduct.php?prod=not_added');
    exit();

  } else {
    move_uploaded_file($product_temp_name, $admin_image_dir_path . $product_image);

    $sql = "INSERT INTO `products`(
      category_id,
      product_name,
      description,
      price, stock_quantity,
      image_url)
      VALUES('$product_category', '$product_name', '$product_description', $product_price, $stock_quantity,  '$product_image')";
    $result = mysqli_query($con, $sql);

    if ($result) {
      header('Location: addproduct.php?added= added');
      exit();
    }
  }
}