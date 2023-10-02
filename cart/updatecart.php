<?php
// Start  the session to use the $_SESSION super global variable.
session_start();
// Include database connection class.
include '../models/Database.php';

// Include CartItem class and instantiate the CartItem class.
include "../models/CartItem.php";

// Include Product class and instantiate the Product class.
include "../models/Product.php";

//Create a new instance of cartItem.
$cartItem = new CartItem(new Database);
$product = new Product(new Database);


//Update the product_quantity
if (isset($_POST['update'])) {

  // Get existing CartItems product Info.
  $existingProductInfo = $cartItem->getCartItemProductInfoById($_POST['product_id'], $_SESSION['user_id']);
  $existingPrice = $existingProductInfo['price'];

  // //Product info for a product ID from the products listings
  $productInfo = $product->getProductInfoById($_POST['product_id']);

  $productStockQuantity = $productInfo['stock_quantity'];


  if ($productStockQuantity >= $_POST['product_quantity']) {
    // Calculate new total price and ensure that the total price is always 2 decimal places.
    $newTotalPrice = ($existingProductInfo['price'] * $_POST['product_quantity'] * 100) / 100;
    // Update the product  quantity
    $cartItem->updateProductQuantity($_POST['product_quantity'], $_POST['product_id'], $_SESSION['user_id']);

    // Update the product total-Price
    $cartItem->updateCartItemTotalPrice($newTotalPrice, $_POST['product_id'], $_SESSION['user_id']);

    //Decrease the stock quantity for the updated product.
    $product->decreaseStockQuantity($_POST['product_id'], $_POST['product_quantity']);

    // Redirect the user to the cart.php when the quanity is updated successfully.
    header('Location:cart.php?updated');
    exit;

  } else {
    header('Location:cart.php?stock');
    exit;
  }
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