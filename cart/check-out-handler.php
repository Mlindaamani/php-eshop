<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";

$total = $cartItem->subTotal(User::id());
$cart->checkoutCart($_POST['cartId']);
$cart->updateCartTotalPrice($total, $_POST['cartId'], User::id());
$cartItem->deleteCartItem(User::id());
redirectTo("cart.php?check-out");