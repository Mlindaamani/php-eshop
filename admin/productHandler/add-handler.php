<?php

require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../models/Product.php';
require_once __DIR__ . '/../../includes/functions.php';

if (isset($_POST['submit'])) {
  //Create new instance of product class.
  $product = new Product(new Database);

  $file = $_FILES['file'];

  $file_name = $file['name'];

  $file_size = $file['size'];

  $file_temp_name = $file['tmp_name'];

  $file_type = $file['type'];

  $file_error = $file['error'];

  define('MAX_FILE_SIZE', 5 * 2040 * 2040);

  //Allowed mime types
  $mime_types = [
    'image/png' => 'png',
    'image/jpeg' => 'jpeg',
    'images/gif' => 'gif',
    'image/apng' => 'apng',
    'image/avif' => 'avif'
  ];


  // Check for a mime type for a uploaded files,
  if (!array_key_exists($file_type, $mime_types)) {
    redirectTo('../product-form.php', 'mime_type');
  }

  //Check Whether fields are empty.
  if (empty($_POST['product_name']) || empty($_POST['pro_description']) || empty($_POST['product_price']) || empty($_POST['stock_quantity']) || empty($file_name)) {
    redirectTo('../product-form.php', 'emptyProductField');
  }

  //Check the file size.
  if ($file_size > MAX_FILE_SIZE) {

    echo "The the file is larger than the maximum file upload file of 5MB";
    redirectTo('../product-form.php', 'larger_file');
  }

  //Insert the product if the product does not exist
  if (!$product->productExist($file_name)) {

    move_uploaded_file($file_temp_name, __DIR__ . '/../../uploads/' . $file_name);

    //Create new Product by calling the create method.
    $product->create($_POST['product_name'], $file_name, $_POST['product_price'], $_POST['pro_description'], $_POST['stock_quantity']);
    redirectTo('../product-form.php', 'new-product');

  } else {
    redirectTo('../product-form.php', 'product_exist');
  }
}