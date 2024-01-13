<?php

require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../../config/config.php";
spl_autoload_register(fn($class) => require_once __DIR__ . "/../../models/{$class}.php");
$product = new Product(new Database);

$file = $_FILES['file'];
$file_name = $file['name'];
$file_size = $file['size'];
$temp_folder = $file['tmp_name'];
$file_type = $file['type'];
$file_error = $file['error'];
$destination = __DIR__ . "/../uploads/{$file_name}";

// Allowed mime types
$mime_types = [
  'image/png' => 'png',
  'image/jpeg' => 'jpeg',
  'images/gif' => 'gif',
  'image/apng' => 'apng',
  'image/avif' => 'avif'
];

// Check for a mime type for a uploaded files,
if (!array_key_exists($file_type, $mime_types)) {
  redirectTo("../product-form.php?mime_type");
}

//Check Whether fields are empty.
if (
  empty($_POST['product_name'])
  || empty($_POST['pro_description'])
  || empty($_POST['product_price'])
  || empty($_POST['stock_quantity'])
  || empty($file_name)
) {
  redirectTo("../product-form.php?emptyProductField");
}

//Check the file size.
if ($file_size > MAX_FILE_SIZE) {
  FILE_SIZE_ERROR_FLASH_MESSAGE;
  redirectTo("../product-form.php?larger_file");
}

if (!$product->isPresent($file_name)) {
  $product->create($_POST['product_name'], $file_name, $_POST['product_price'], $_POST['pro_description'], $_POST['stock_quantity']);
  move_uploaded_file($temp_folder, $destination);
  redirectTo("../product-form.php?new-product");
} else {
  redirectTo("../product-form.php?product_exist");
}