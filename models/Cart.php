<?php
/**
 * Summary of Cart
 */
class Cart {
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
   * Summary of createNewCart
   * @param mixed $userId
   * @return void
   */
  public function createNewCart($userId)
  {
    // If no active cart create new cart.
    if (!$this->isCartActive($userId)) {
      $this->insertDataIntoCart($userId);
    }
  }

  /**
   * Summary of isCartActive
   * Active cart is the cart with user_id and checked_out is equal to false.
   * @param mixed $userId
   * @return bool
   */
  public function isCartActive($userId)
  {
    $stmt = $this->database->prepare("SELECT user_id FROM carts WHERE user_id = ? AND checked_out = ?");
    $stmt->execute([$userId, 0]);
    $activeCartId = $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($activeCartId['user_id']);
  }

  /**
   * Summary of insertDataIntoCart
   * @param mixed $userId
   * @return void
   */
  function insertDataIntoCart($userId)
  {
    $stmt = $this->database->prepare("INSERT INTO carts (user_id, total_price, checked_out) VALUES (?, ?, ?)");
    $stmt->execute([$userId, 0.00, 0]);
  }

  /**
   * Summary of getCartId
   * @param mixed $userId
   * @return mixed
   */
  function getCartId($userId)
  {
    $stmt = $this->database->prepare("SELECT id FROM carts WHERE user_id = ? AND checked_out = ?");
    $stmt->execute([$userId, 0]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    return $cart['id'];
  }

  /**
   * Summary of getUserCartInfo
   * @param mixed $userId
   * @return mixed
   */
  function getUserCartInfo($userId)
  {
    $stmt = $this->database->prepare("SELECT * FROM carts WHERE user_id = ?");
    $stmt->execute([$userId]);
    $userCartInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $userCartInfo;
  }

  //RETURN A SUCCESSFULLY MESSAGE WHEN A CART IS CHECKED

  /**
   * Summary of checkoutCart
   * @param mixed $cartId
   * @return void
   */
  public function checkoutCart($cartId)
  {
    $stmt = $this->database->prepare("UPDATE carts SET checked_out = ? WHERE id = ?");
    $stmt->execute([1, $cartId]);
  }

  public function updateCartTotalPrice($total_price, $cart_id, $user_id)
  {
    $stmt = $this->database->prepare("UPDATE carts SET total_price = ?, user_id = ? WHERE id = ?");
    $stmt->execute([$total_price, $user_id, $cart_id]);
  }

  //CLEAR THE USER CART.
  /**
   * Summary of clearCart
   * @param mixed $user_id
   * @return void
   */
  function clearCart($user_id)
  {
    $stmt = $this->database->prepare("DELETE FROM carts WHERE user_id = ?");
    $stmt->execute([$user_id]);
  }
}