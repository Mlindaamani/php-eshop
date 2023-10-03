<?php
// Start  the session to use the $_SESSION super global variable.
session_start();
// Include database connection class.
include '../models/Database.php';
// Include CartItem class and instantiate the CartItem class.
include "../models/CartItem.php";
// Include Product class and instantiate the Product class.
include "../models/Product.php";
// Include Cart class and instantiate the Cart class.
include "../models/Cart.php";
//Create a new instance of cartItem.
$cartItem = new CartItem(new Database);
//Create a new instance of cartItem.
$product = new Product(new Database);
//Create a new instance of Cart.
$cart = new Cart(new Database);

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
    //Redirect the user to cartItems page with error message when the stock quantity is not enogh for the selected product.
  } else {
    header('Location:cart.php?stock');
    exit;
  }
}


//Remove individual cart_item from cartItem table
if ((isset($_POST['remove'])) && ($cartItem->getItemsCount($_SESSION['user_id']) > 0)) {
  //Clear individul cart item.
  $cartItem->removeCartItem($_POST['cartItemId'], $_POST['product_id']);
  //Add the quantity deleted
  $product->increaseStockQuantity($_POST['product_id'], $_POST['product_quantity']);
  header('Location:cart.php');
  exit;

} else {
  //Clear the cart.
  $cart->clearCart($_SESSION['user_id']);
  header('Location:cart.php');

}