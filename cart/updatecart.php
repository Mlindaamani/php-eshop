<?php
// Start  the session to use the $_SESSION super global variable.
session_start();
// Include database connection class.
include '../models/Database.php';

// Include CartItem class and instantiate the CartItem class.
include '../models/CartItem.php';

//Create a new instance of cartItem.
$cartItem = new CartItem(new Database);

//Update the product_quantity
if (isset($_POST['update'])) {
  // Get existing CartItems product Info.
  $existingProductInfo = $cartItem->getCartItemProductInfoById($_POST['product_id'], $_SESSION['user_id']);

  $existingPrice = $existingProductInfo['price'];

  // Calclute new Product total price
  $newTotalPrice = $existingProductInfo['price'] * $_POST['product_quantity'];
  // Update the product  quantity
  $cartItem->updateProductQuantity($_POST['product_quantity'], $_POST['product_id'], $_SESSION['user_id']);

  // Update the product taotal price
  $cartItem->updateCartItemTotalPrice($newTotalPrice, $_POST['product_id'], $_SESSION['user_id']);

  // Redirect the user to the cart.php when the quanity is updated successfully.
  header('Location:cart.php');
  exit;
}

//Delete the product from the cartItems table.
if (isset($_POST['remove'])) {
  $cartItem->removeCartItem($_POST['cartItemId'], $_POST['product_id']);
  header('Location:cart.php');
  exit;
}


if (isset($_POST['deleteCart'])) {
  $cartItem->clearCart();
  header('Location:cart.php');
  exit;
}