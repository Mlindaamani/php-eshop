<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";


if (isset($_POST['update'])) {

  if (CartItem::isStockEnough($_POST['product_id'], $_POST['product_quantity'], $product)) {
    $cartProductPrice = $cartItem->getCartItemPrice($_POST['product_id'], User::id());
    $newTotalPrice = CartItem::calculateTotalPrice($cartProductPrice, $_POST['product_quantity']);
    $cartItem->updateProductQuantity($_POST['product_quantity'], $_POST['product_id'], User::id());
    $cartItem->updateCartItemTotalPrice($newTotalPrice, $_POST['product_id'], User::id());
    redirectTo("cart.php");
  } else {
    redirectTo("cart.php?stock");
  }
}


if (isset($_POST['remove'])) {
  $cartItem->removeCartItem($_POST['cartItem_id'], $_POST['product_id']);
  $product->increaseStockQuantity($_POST['product_id'], $_POST['product_quantity']);
  redirectTo("cart.php");
}