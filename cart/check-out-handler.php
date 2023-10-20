<?php
session_start();
spl_autoload_register(function ($class) {

  require_once __DIR__ . "/../models/$class.php";
});

require_once __DIR__ . '/../includes/functions.php';

$cartItem = new CartItem(new Database);

$total = $cartItem->subTotal($_SESSION['user_id']);


if (isset($_POST['check-out'])) {

  $cart = new Cart(new Database);

  //Check out the cart when a check out button is clicked.
  $cart->checkoutCart($_POST['cartId']);

  //Update the total price for a certain acart and user_id .
  $cart->updateCartTotalPrice($total, $_POST['cartId'], $_SESSION['user_id']);

  redirectTo('cart.php', 'check-out');
}