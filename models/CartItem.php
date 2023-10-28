<?php
/**
 * Summary of CartItem
 */
class CartItem {

  /**
   * Summary of database
   * @var 
   */
  private $database;

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database->dbconnection();
  }

  /**
   * Summary of addToCart
   * @param mixed $product_name
   * @param mixed $quantity
   * @param mixed $product_image
   * @param mixed $price
   * @param mixed $total_price
   * @param mixed $user_id
   * @param mixed $product_id
   * @param mixed $cart_id
   * @return void
   */
  public function addToCart($product_name, $quantity, $product_image, $price, $total_price, $user_id, $product_id, $cart_id)
  {
    $stmt = $this->database->prepare("INSERT INTO cart_items (product_name, quantity, product_image, price, total_price, user_id, product_id, cart_id)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$product_name, $quantity, $product_image, $price, $total_price, $user_id, $product_id, $cart_id]);
  }



  //UPDATE_CARTITEMS_QUANTITY.
  /**
   * Summary of updateProductQuantity
   * @param mixed $quantity
   * @param mixed $product_id
   * @param mixed $user_id
   * @return void
   */
  public function updateProductQuantity($quantity, $product_id, $user_id)
  {
    $stmt = $this->database->prepare("UPDATE cart_items SET quantity = ? WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$quantity, $product_id, $user_id]);

  }

  //UPDATE_PRODUCT_QUANTITY_AND_TOTAL_PRICE:
  /**
   * Summary of updateCartItemTotalPrice
   * @param mixed $total_price
   * @param mixed $product_id
   * @param mixed $user_id
   * @return void
   */
  function updateCartItemTotalPrice($total_price, $product_id, $user_id)
  {

    $stmt = $this->database->prepare("UPDATE cart_items SET  total_price = ? WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$total_price, $product_id, $user_id]);
  }


  //GET_CART_ITEMS_INFO_BY_ID:
  /**
   * Summary of getCartItemProductInfoById
   * @param mixed $product_id
   * @param mixed $user_id
   * @return mixed
   */
  function getCartItemProductInfoById($product_id, $user_id)
  {

    $stmt = $this->database->prepare("SELECT * FROM cart_items WHERE product_id = ? AND user_id = ?");
    $stmt->execute([$product_id, $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  //GET_CART_SUB_TOTAL:
  /**
   * Summary of subTotal
   * @param mixed $user_id
   * @return float
   */
  public function subTotal($user_id): float
  {
    $stmt = $this->database->prepare("SELECT SUM(total_price) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }

  //SUM ALL PRODUCT QUANTITY FOR A AUTHENTICATED USER.

  /**
   * Summary of getTotalProductQuantity
   * @param mixed $user_id
   * @return int
   */
  public function getTotalProductQuantity($user_id): int
  {
    $stmt = $this->database->prepare("SELECT SUM(quantity) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }

  //GET_NUMBER_OF_RECORDS_IN_CARTITEMS_TABLE:
  /**
   * Summary of getItemsCount
   * @param mixed $user_id
   * @return mixed
   */
  public function getItemsCount($user_id)
  {
    $stmt = $this->database->prepare("SELECT COUNT(*) FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
  }

  //DELETE_INDIVIDUAL_CART_ITEM:
  /**
   * Summary of removeCartItem
   * @param mixed $cartItemId
   * @param mixed $productId
   * @return void
   */
  function removeCartItem($cartItemId, $productId)
  {
    $stmt = $this->database->prepare("DELETE FROM cart_items WHERE id = ? AND product_id = ?");
    $stmt->execute([$cartItemId, $productId]);
    $stmt = new CartItem(new Database);
  }

  //GET_ALL_CART_ITEMS_PRODUCT_INFO:
  /**
   * Summary of getAllCartItems
   * @param mixed $user_id
   * @return array
   */
  function getAllCartItems($user_id)
  {
    $stmt = $this->database->prepare("SELECT * FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!count($result)) {
      echo 'No products for a given user_id!';
    }
    return $result;
  }


  //DELETE_ALL_CART_ITEMS:
  /**
   * Summary of clearCartItem
   * @param mixed $user_id
   * @return void
   */
  function clearCartItem($user_id)
  {
    $stmt = $this->database->prepare("DELETE FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
  }
}