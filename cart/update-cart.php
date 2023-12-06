<?php
session_start();

require_once __DIR__ . '/../includes/functions.php';

//Fuction to autoload class.
spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});

$cartItem = new CartItem(new Database);

$product = new Product(new Database);

$cart = new Cart(new Database);

$userId = $_SESSION['user_id'];

//Update the product_quantity
if (isset($_POST['update'])) {

  // Get existing CartItems product Info.
  $existingProductInfo = $cartItem->getCartItemProductInfoById($_POST['product_id'], $userId);
  $existingPrice = $existingProductInfo['price'];

  // //Product info for a product ID from the products listings
  $productInfo = $product->getProductInfoById($_POST['product_id']);
  $productStockQuantity = $productInfo['stock_quantity'];

  if ($productStockQuantity >= $_POST['product_quantity']) {

    // Calculate new total price and ensure that the total price is always 2 decimal places.
    $newTotalPrice = ($existingProductInfo['price'] * $_POST['product_quantity'] * 100) / 100;

    // Update the product  quantity
    $cartItem->updateProductQuantity($_POST['product_quantity'], $_POST['product_id'], $userId);

    // Update the product total-Price
    $cartItem->updateCartItemTotalPrice($newTotalPrice, $_POST['product_id'], $userId);
    redirectTo('cart.php');

  } else {
    redirectTo('cart.php', 'stock');
  }
}

//REMOVE FUNCTIONALITY.
if (isset($_POST['remove'])) {
  $cartItem->removeCartItem($_POST['cartItem_id'], $_POST['product_id']);
  $product->increaseStockQuantity($_POST['product_id'], $_POST['product_quantity']);
  redirectTo('cart.php');
}