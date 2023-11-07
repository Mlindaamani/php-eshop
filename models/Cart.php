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

  private const UNCHECKED_CART_STATUS = 0;

  private const CHECHED_CART_STATUS = 1;

  private const MY_DATA_FETCH_MODE = PDO::FETCH_ASSOC;

  private const TABLE_NAME = 'carts';

  private const INITIAL_TOTAL_PRICE = 0.00;

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
    $stmt = $this->database->prepare("SELECT user_id FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id AND checked_out = :unchecked_out_status");
    $stmt->execute([
      'user_id' => $userId,
      'checked_out_status' => self::UNCHECKED_CART_STATUS
    ]);
    $activeCartId = $stmt->fetch(self::MY_DATA_FETCH_MODE);
    return isset($activeCartId['user_id']);
  }

  /**
   * Summary of insertDataIntoCart
   * @param mixed $userId
   * @return void
   */
  function insertDataIntoCart($userId)
  {
    $stmt = $this->database->prepare("INSERT INTO " . self::TABLE_NAME .
      " (user_id, total_price, checked_out) VALUES (:user_id, :total_price, :unchecked_out_status)");
    $stmt->execute([
      'user_id' => $userId,
      'total_price' => self::INITIAL_TOTAL_PRICE,
      'checked_out_status' => self::UNCHECKED_CART_STATUS
    ]);
  }

  /**
   * Summary of getCartId
   * @param mixed $userId
   * @return mixed
   */
  function getCartId($userId)
  {
    $stmt = $this->database->prepare("SELECT id FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id AND checked_out = :uncheched_out_status");
    $stmt->execute([
      'cheched_out_status' => self::UNCHECKED_CART_STATUS,
      'user_id' => $userId
    ]);
    $cart = $stmt->fetch(self::MY_DATA_FETCH_MODE);
    return $cart['id'];
  }

  /**
   * Summary of getUserCartInfo
   * @param mixed $userId
   * @return mixed
   */
  function getUserCartInfo($userId)
  {
    $stmt = $this->database->prepare("SELECT * FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id");
    $stmt->execute([
      'user_id' => $userId
    ]);
    $userCartInfo = $stmt->fetch(self::MY_DATA_FETCH_MODE);
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
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET checked_out = :cheched_out_status WHERE id = :cart_id");
    $stmt->execute([
      'cheched_out_status' => self::CHECHED_CART_STATUS,
      'cart_id' => $cartId
    ]);
  }

  public function updateCartTotalPrice($totalPrice, $cartId, $userId)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      "SET total_price = :total_price, user_id = :user_id WHERE id = :id");
    $stmt->execute([
      'id' => $cartId,
      'total_price' => $totalPrice,
      'user_id' => $userId
    ]);
  }

  //CLEAR THE USER CART.
  /**
   * Summary of clearCart
   * @param mixed $user_id
   * @return void
   */
  function clearCart($userId)
  {
    $stmt = $this->database->prepare("DELETE FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
  }
}