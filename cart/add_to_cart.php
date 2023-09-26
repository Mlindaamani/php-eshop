<?php
session_start();
//Include all the appropriate classes.
include '../models/db.php';
include '../models/Product.php';
include '../models/CartItem.php';
include '../models/Cart.php';

//Create instances of the classes.
$db = new Database();
$product = new Product($db);
$cartItem = new CartItem($db);
$cart = new Cart($db);
$userId = $_SESSION['user_id'];
$productId = $_POST['id'];


if (isset($_POST['add_to_cart'])) {
  $cart->createNewCart($userId);
  $cartItem->addToCart($cart->getCartId($userId), $productId, 1, $userId);
  header('Location: ../index.php?newitem');
  exit;
}