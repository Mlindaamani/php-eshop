<?php
session_start();
// Include the classes needed for the adding to cart functionality.
include '../models/Database.php';
include '../models/CartItem.php';
include '../models/Product.php';
include '../models/Cart.php';

//Create new instance of the database.
$db = new Database();

//Create a new instance of cartItem.
$cartItem = new CartItem($db);

//Create a new instance of cartItem.
$cart = new Cart($db);

//Get the user_id from the session variable.
$userId = $_SESSION['user_id'];

//Get product id from the product listing form.
$productId = $_POST['id'];


if (isset($_POST['add_to_cart'], $_SESSION['user_id'])) {

  //Create a new cart if the user is logged in and the check_out id false.
  $cart->createNewCart($userId);

  //Add a product into the cart if the above conditions are true.
  $cartItem->addToCart($cart->getCartId($userId), $productId, 1, $userId);

  //Redirect the user to the same page with the message indicating the product has been added successfully!
  header('Location: ../index.php?newitem');
  exit;

} else {
  //Redirect the user to the login page if they are not logged in and trying to add product in the cart.
  header("Location: ../login.php?login");
}