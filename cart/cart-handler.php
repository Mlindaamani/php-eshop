<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";


if (User::isLoggedIn()) {

  if ($cartItem->isCartItemPresent($_POST[CURRENT_PRODUCT_ID], User::id())) {
    $cartItem->increaseQuantity($_POST[CURRENT_PRODUCT_ID], User::id());
    redirectTo("../index.php?yes");

  } else {
    $cartItem->addToCart(User::id(), $product, $cart, $_POST[CURRENT_PRODUCT_ID]);
    $product->decreaseStockQuantity($_POST[CURRENT_PRODUCT_ID], INITIAL_PRODUCT_QUANTITY);
    redirectTo("../index.php");
  }

} else {
  redirectTo("../login.php?login");
}

