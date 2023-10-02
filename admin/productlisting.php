<?php
//Include database from the actions folder.
include "../actions/db_connection.php";

//Handle Product submision
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
  $admin_image_dir_path = realpath(__DIR__) . "/uploads/images/";


  $sql_results = mysqli_query(databaseConnection(), "SELECT image_url, product_name FROM products WHERE product_name=' $product_name' OR image_url = '$product_image'");

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
    $result = mysqli_query(databaseConnection(), $sql);

    if ($result) {
      header('Location: addproduct.php?added');
      exit();
    }
  }
}