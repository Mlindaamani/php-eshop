<?php
session_start();
// Include the classes needed for the adding to cart functionality.
include '../models/Database.php';
include '../models/CartItem.php';
include '../models/Product.php';
include '../models/Cart.php';
$cartItem = new CartItem(new Database);
$product = new Product(new Database);
$cart = new Cart(new Database);


if (isset($_POST['add'], $_SESSION['user_id'])) {
  // Existing productinfo for a product ID. Remember the existing product_id in this case is equal to the incommig productId from product listing page
  $existingProductInfo = $cartItem->getCartItemProductInfoById($_POST['id'], $_SESSION['user_id']);
  $existingProductId = $existingProductInfo['product_id'];

  //Check whether the product already added in the cart.
  if ($_POST['id'] == $existingProductInfo['product_id']) {
    header('Location: ../index.php?yes');
    exit;

  } else {
    //Create a new cart if user_id isset and the check_out id false.
    $cart->createNewCart($_SESSION['user_id']);

    //Obtain a created cardId
    $cartId = $cart->getCartId($_SESSION['user_id']);

    //Get product info from the product table for the product clicked from the product listing.
    $productInfo = $product->getProductInfoById($_POST['id']);

    //Add the products info into the cartItems table. Remember the initial quantity will be 1 because i dont allow mutiple selection of product.
    $cartItem->addToCart($productInfo['product_name'], 1, $productInfo['image_url'], $productInfo['price'], $productInfo['price'], $_SESSION['user_id'], $_POST['id'], $cartId);

    //Decrease the stock_quantity for a product with $_POST['id] by 1;
    $product->decreaseStockQuantity($_POST['id'], 1);

    //Redirect the user to the same page.
    header('Location: ../index.php');
    exit;
  }

} else {
  //Redirect the user to the login page when accepts to add product to the cart without logging in.
  header('Location: ../login.php?login');
  exit;
}