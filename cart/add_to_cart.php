<?php
session_start();
// Include the classes needed for the adding to cart functionality.
include '../models/Database.php';
include '../models/CartItem.php';
include '../models/Product.php';
include '../models/Cart.php';
//Create a new instance of cartItem.
$cartItem = new CartItem(new Database);
//Create a new instance of cartItem.
$product = new Product(new Database);
//Create a new instance of cartItem.
$cart = new Cart(new Database);



if (isset($_POST['add_to_cart'], $_SESSION['user_id'])) {
  // Existing productinfo for a product ID. Remember the existing product_id in this case is equal to the incommig productId.
  $existingProductInfo = $cartItem->getCartItemProductInfoById($_POST['id'], $_SESSION['user_id']);
  $existingProductId = $existingProductInfo['product_id'];
  if ($_POST['id'] == $existingProductInfo['product_id']) {
    header('Location: ../index.php?yes');
    exit;

  } else {
    //Create a new cart if the user is logged in and the check_out id false.
    $cart->createNewCart($_SESSION['user_id']);
    //CartID
    $cartId = $cart->getCartId($_SESSION['user_id']);
    //Add product to cart.
    $productInfo = $product->getProductInfoById($_POST['id']);
    $cartItem->addToCart($productInfo['product_name'], 1, $productInfo['image_url'], $productInfo['price'], $productInfo['price'], $_SESSION['user_id'], $_POST['id'], $cartId);
    $product->decreaseStockQuantity($_POST['id'], 1);
    header('Location: ../index.php?newitem');
    exit;
  }
} else {
  header('Location: ../login.php?login');
}