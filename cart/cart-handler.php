<?php

session_start();
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . "/../config/config.php";
spl_autoload_register(fn($class) => require_once __DIR__ . "/../models/{$class}.php");

$cartItem = new CartItem(new Database);
$product = new Product(new Database);
$cart = new Cart(new Database);
$user = new User(new Database);

if (User::isLoggedIn()) {

  if ($cartItem->isCartItemPresent($_POST[CURRENT_PRODUCT_ID], User::id())) {
    redirectTo("../index.php?yes");

  } else {
    $cartItem->addToCart(User::id(), $product, $cart, $_POST[CURRENT_PRODUCT_ID]);
    $product->decreaseStockQuantity($_POST[CURRENT_PRODUCT_ID], INITIAL_PRODUCT_QUANTITY);
    redirectTo("../index.php");
  }

} else {
  redirectTo("../login.php?login");
}