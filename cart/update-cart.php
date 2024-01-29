<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";


if (isset($_POST['update'])) {

  if (CartItem::isStockEnough($_POST['product_id'], $_POST['product_quantity'], $product)) {

    $cartItem->updateCartItemTotalPrice($_POST['product_id'], User::id(), $_POST['product_quantity']);

    redirectTo("cart.php");

  } else {
    redirectTo("cart.php?stock");
  }
}

if (isset($_POST['remove'])) {

  $cartItem->removeCartItem($_POST['cartItem_id'], $_POST['product_id'], $_POST['product_quantity'], $product);

  redirectTo("cart.php");
}