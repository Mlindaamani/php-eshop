<?php
session_start();

require_once __DIR__ . '/../includes/functions.php';

require_once __DIR__ . "/../config/config.php";

spl_autoload_register(function ($class) {

  require __DIR__ . "/../models/$class.php";
});


$cartItem = new CartItem(new Database);

$product = new Product(new Database);

$cart = new Cart(new Database);

$user = new User(new Database);

if (isset($_POST['add']) && $user->isLoggedIn()) {

  $existingProductInfo = $cartItem->getCartItemProductInfoById(
    $_POST[CURRENT_PRODUCT_ID],
    $_SESSION[CURRENT_USER]
  );

  $existingProductId = $existingProductInfo['product_id'];

  if ($_POST['id'] == $existingProductInfo['product_id']) {
    redirectTo('../index.php', 'yes');

  } else {
    $cart->createCart($_SESSION[CURRENT_USER]);

    $cartId = $cart->getCartId($_SESSION[CURRENT_USER]);

    //Get product info from the product table for the product clicked from the product listing.
    $productInfo = $product->getProductInfoById($_POST[CURRENT_PRODUCT_ID]);

    //Add product to cart.
    $cartItem->addToCart(

      $productInfo['product_name'],

      INITIAL_PRODUCT_QUANTITY,

      $productInfo['image_url'],

      $productInfo['price'],

      $productInfo['price'],

      $_SESSION[CURRENT_USER],

      $_POST[CURRENT_PRODUCT_ID],

      $cartId
    );

    $product->decreaseStockQuantity($_POST[CURRENT_PRODUCT_ID], INITIAL_PRODUCT_QUANTITY);
    redirectTo('../index.php');
  }
} else {
  redirectTo('../login.php', 'login');
}