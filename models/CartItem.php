<?php
// include "Database.php";
// CartItem Model
class CartItem {


  private $database;


  public function __construct(Database $database)
  {
    $this->database = $database;
  }



  public function addToCart($product_name, $quantity, $product_image, $price, $total_price, $user_id, $product_id, $cart_id)
  {
    $stmt = $this->database->dbconnection()->prepare("INSERT INTO cart_items (product_name, quantity, product_image, price, total_price, user_id, product_id, cart_id)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$product_name, $quantity, $product_image, $price, $total_price, $user_id, $product_id, $cart_id]);
  }


  //UPDATE_CARTITEMS_QUANTITY.
  public function updateProductQuantity($quanity, $product_id, $user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("UPDATE cart_items SET quantity = ? WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$quanity, $product_id, $user_id]);

  }


  //UPDATE_PRODUCT_QUANTITY_AND_TOTAL_PRICE:
  function updateCartItemTotalPrice($total_price, $product_id, $user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("UPDATE cart_items SET  total_price = ? WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$total_price, $product_id, $user_id]);
  }



  //GET_CART_ITEMS_INFO_BY_ID:
  function getCartItemProductInfoById($product_id, $user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM cart_items WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$product_id, $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }



  //GET_CART_SUB_TOTAL:
  public function subTotal($user_id): float
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT SUM(total_price) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }


  //SUM ALL PRODUCT QUANTITY FOR A AUTHENTICATED USER.
  public function getTotalProductQuantity($user_id): int
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT SUM(quantity) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }


  //GET_NUMBER_OF_RECORDS_IN_CARTITEMS_TABLE:
  public function getItemsCount($user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT COUNT(*) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }



  //DELETE_INDIVIDUAL_CART_ITEM:
  function removeCartItem($cartItemId, $productId)
  {
    $stmt = $this->database->dbconnection()->prepare("DELETE FROM cart_items WHERE id = ? AND product_id = ?");
    $stmt->execute([$cartItemId, $productId]);
  }



  //GET_ALL_CART_ITEMS_PRODUCT_INFO:
  function getAllCartItems($user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  //DELETE_ALL_CART_ITEMS:
  function clearCartItem($user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("DELETE FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
  }

}