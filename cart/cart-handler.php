<?php
session_start();

spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});

require_once __DIR__ . '/../includes/functions.php';

$cartItem = new CartItem(new Database);

$product = new Product(new Database);

$cart = new Cart(new Database);

$userId = $_SESSION['user_id'];

if (isset($_POST['add']) && isset($userId)) {

  // Existing productinfo for a product ID. Remember the existing product_id in this case is equal to the incommig productId from product listing page
  $existingProductInfo = $cartItem->getCartItemProductInfoById($_POST['id'], $userId);

  $existingProductId = $existingProductInfo['product_id'];

  //Check whether the product already added in the cart.
  if ($_POST['id'] == $existingProductInfo['product_id']) {
    //Redirect to home page when the product alredy present in the cart.
    redirectTo('../index.php', 'yes');

  } else {
    //Create a new cart if user_id isset and the check_out id false.
    $cart->createNewCart($userId);

    //Obtain a created cardId
    $cartId = $cart->getCartId($userId);

    //Get product info from the product table for the product clicked from the product listing.
    $productInfo = $product->getProductInfoById($_POST['id']);

    //Add the products info into the cartItems table. Remember the initial quantity will be 1 because i dont allow mutiple selection of product.
    $cartItem->addToCart($productInfo['product_name'], 1, $productInfo['image_url'], $productInfo['price'], $productInfo['price'], $userId, $_POST['id'], $cartId);

    //Decrease the stock_quantity for a product with $_POST['id] by 1;
    $product->decreaseStockQuantity($_POST['id'], 1);

    //Redirect the user to the same page.
    redirectTo('../index.php');
  }

} else {
  //Redirect the user to the login page when accepts to add product to the cart without logging in.
  redirectTo('../login.php', 'login');
}