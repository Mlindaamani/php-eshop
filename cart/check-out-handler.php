<?php
session_start();
spl_autoload_register(fn($class) => require_once __DIR__ . "/../models/{$class}.php");
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . "/../config/config.php";
$cartItem = new CartItem(new Database);
$cart = new Cart(new Database);

$total = $cartItem->subTotal(User::id());
$cart->checkoutCart($_POST['cartId']);
$cart->updateCartTotalPrice($total, $_POST['cartId'], User::id());
$cartItem->deleteCartItem(User::id());
redirectTo("cart.php?check-out");