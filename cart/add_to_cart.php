<?php
session_start();
// Include the classes needed for the adding to cart functionality.
include '../models/Database.php';
include '../models/CartItem.php';
include '../models/Product.php';
include '../models/Cart.php';

//Create a new instance of cartItem.
$cartItem = new CartItem(new Database);

//Create a new instance of cartItem.
$product = new Product(new Database);

//Create a new instance of cartItem.
$cart = new Cart(new Database);

//Get the user_id from the session variable.
$userId = $_SESSION['user_id'];

//Get product id from the product listing form.
$productId = $_POST['id'];

// Cart_id
$cartId = $cart->getCartId($userId);


//Product info for a product ID from the products listings
$productInfo = $product->getProductInfoById($productId);
$productName = $productInfo['product_name'];
$productImage = $productInfo['image_url'];
$productPrice = $productInfo['price'];
$productStockQuantity = $productInfo['stock_quantity'];


//Existing productinfo for a product ID. Remember the existing product_id in this case is equal to the incommig productId.
$existingProductInfo = $cartItem->getCartItemProductInfoById($productId, $userId);
$existingCartId = $existingProductInfo['cart_id'];
$existingProductId = $existingProductInfo['product_id'];
$existingPrice = $existingProductInfo['price'];
$existingUserId = $existingProductInfo['user_id'];
$existingProductQuantity = $existingProductInfo['quantity'];
$existingProductTotalPrice = $existingProductInfo['total_price'];



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