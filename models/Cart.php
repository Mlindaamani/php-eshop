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

  private const CHECKED_CART_STATUS = 1;

  private const MY_CART_FETCH_MODE = PDO::FETCH_ASSOC;

  private const TABLE_NAME = "carts";

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
  public function createCart($userId)
  {
    if (!$this->isCartActive($userId)) {

      $this->insertDataIntoCart($userId);
    }
  }

  /**
   * Summary of isCartActive
   * @param int $userId
   * @return bool
   */
  public function isCartActive(int $userId)
  {
    $stmt = $this->database->prepare("SELECT user_id FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id AND checked_out = :unchecked_cart_status");
    $stmt->execute(["user_id" => $userId, "unchecked_cart_status" => self::UNCHECKED_CART_STATUS]);
    return $stmt->rowCount() == 1 ? true : false;
  }

  /**
   * Summary of insertDataIntoCart
   * @param mixed $userId
   * @return void
   */
  function insertDataIntoCart($userId)
  {
    $stmt = $this->database->prepare("INSERT INTO " . self::TABLE_NAME .
      " (user_id, total_price, checked_out) VALUES (:user_id, :total_price, :unchecked_cart_status)");
    $stmt->execute([
      "user_id" => $userId,
      "total_price" => self::INITIAL_TOTAL_PRICE,
      "unchecked_cart_status" => self::UNCHECKED_CART_STATUS
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
      " WHERE user_id = :user_id AND checked_out = :unchecked_cart_status");
    $stmt->execute([
      "unchecked_cart_status" => self::UNCHECKED_CART_STATUS,
      "user_id" => $userId
    ]);
    return $stmt->fetch(self::MY_CART_FETCH_MODE)['id'];
  }

  /**
   * Summary of checkoutCart
   * @param int $cartId
   * @return void
   */
  public function checkoutCart(int $cartId)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET checked_out = :checked_cart_status WHERE id = :cart_id");
    $stmt->execute([
      "checked_cart_status" => self::CHECKED_CART_STATUS,
      "cart_id" => $cartId
    ]);
  }

  /**
   * Summary of updateCartTotalPrice
   * @param mixed $totalPrice
   * @param mixed $cartId
   * @param mixed $userId
   * @return void
   */
  public function updateCartTotalPrice(float $totalPrice, int $cartId, int $userId)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET total_price = :total_price, user_id = :user_id WHERE id = :id");
    $stmt->execute([
      "id" => $cartId,
      "total_price" => $totalPrice,
      "user_id" => $userId
    ]);
  }

  public function checkedOutCarts(int $userId)
  {

    $stmt = $this->database->prepare("SELECT checked_out FROM carts WHERE checked_out = :checked_out AND user_id = :user_id");
    $stmt->execute(['checked_out' => self::CHECKED_CART_STATUS, 'user_id' => $userId]);
    return count($stmt->fetchAll());
  }

  public function uncheckedCarts(int $userId)
  {
    $stmt = $this->database->prepare("SELECT checked_out FROM carts WHERE checked_out = :unchecked_carts AND user_id = :user_id");
    $stmt->execute(['checked_out' => self::UNCHECKED_CART_STATUS, 'user_id' => $userId]);
    return count($stmt->fetchAll()) > 0 ? count($stmt->fetchAll()) : 0;
  }
}
