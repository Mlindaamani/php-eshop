<!--  Include header contents  -->
<?php include('../includes/header.php') ?>

<!-- Include the sidebar -->
<div class='row mt-3 gx-2'>
  <div class='col-md-2 border shadow mt-3'>
    <?php include '../includes/sidepanel.php' ?>
  </div>

  <!-- Include the 10 colums to display the forms-->
  <div class='col-md-10 border shadow mt-3'>
    <!-- Display the error message whem the product is already Present -->
    <?php if (isset($_GET['emptyProductField'])) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Kindly fil all the fields
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php } ?>


    <!-- Display the succes message when the product is added Successfully-->
    <?php if (isset($_GET['prod'])) { ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Product inserted Successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><button>
      </div>
    <?php } ?>


    <div class='container d-flex justify-content-center align-items-center mb-3 w-75 h-80 mt-3 '>
      <!-- Product addition form -->
      <form action='' method='post' class='border shadow p-3 rounded w-50' enctype='multipart/form-data'>
        <div class='mb-3'>
          <h5 class='text-center p-3'>Add Products</h5>

          <label class='form-label'>Enter product name</label>
          <input type='text' name='product_name' class='form-control'>
        </div>

        <div class='mb-3'>
          <label for='lastname' class='form-label'>Enter Product Description</label>
          <input type='text' name='pro_description' class='form-control'>
        </div>


        <div class='mb-3'>
          <label class='form-label'>Enter Product Price</label>
          <input type='number' name='product_price' class='form-control' step='0.01'>
        </div>

        <div class='mb-3'>
          <label class='form-label'>Enter Stock Quantity</label>
          <input type='number' name='stock_quantity' class='form-control'>
        </div>

        <div class='mb-3'>
          <label class='form-label'>Enter Product Image</label>
          <input type='file' name='product_image' class='form-control'>

          <div class='mb-3 mt-3'>
            <button type='submit' class='btn btn-primary w-100 mb-2 border shadow' name='submit'>Add</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_POST['submit'])) {

  $product_name = $_POST['product_name'];

  $product_description = $_POST['pro_description'];

  $product_price = $_POST['product_price'];

  $stock_quantity = $_POST['stock_quantity'];

  $product_image = $_FILES['product_image']['name'];

  $product_temp_name = $_FILES['product_image']['tmp_name'];

  if (empty($product_name) || empty($product_description) || empty($product_price) || empty($stock_quantity)) {
    header('Location: addproduct.php?emptyProductField');
    exit;
  }

  //Obtain the full path of the image directory.
  $admin_image_dir_path = realpath(__DIR__) . '/uploads/images/';


  $sql_results = mysqli_query($con, "SELECT image_url, product_name FROM products WHERE product_name=' $product_name' OR image_url = '$product_image'");

  $number_rows = mysqli_num_rows($sql_results);

  if ($number_rows > 0) {
    header('Location: addproduct.php?prod');
    exit();

  } else {

    // Move the aploaded image url into the images folder in aploads
    move_uploaded_file($product_temp_name, $admin_image_dir_path . $product_image);

    // Construct a query for adding the product to the database.
    $sql = "INSERT INTO products(
      product_name,
      description,
      price, stock_quantity,
      image_url)
      VALUES('$product_name', '$product_description', $product_price, $stock_quantity,  '$product_image')";

    // Excuted the sql statement
    $result = mysqli_query(dbconnect(), $sql);

    if ($result) {
      header('Location: addproduct.php?added');
      exit();
    }
  }
}
?>