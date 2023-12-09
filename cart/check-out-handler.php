<?php
session_start();

spl_autoload_register(function ($class) {

  require_once __DIR__ . "/../models/$class.php";
});

require_once __DIR__ . '/../includes/functions.php';

require_once __DIR__ . "/../config/app-config.php";

$cartItem = new CartItem(new Database);

$total = $cartItem->subTotal($_SESSION[CURRENT_USER]);

$cart = new Cart(new Database);

$cart->checkoutCart($_POST['cartId']);

$cart->updateCartTotalPrice($total, $_POST['cartId'], $_SESSION[CURRENT_USER]);

$cartItem->deleteCartItem($_SESSION[CURRENT_USER]);

redirectTo('cart.php', 'check-out');