<?php

class Cart {

  private $database;


  public function __construct(Database $database)
  {
    $this->database = $database;
  }


  public function createNewCart($userId)
  {
    // If no active cart create new cart.
    if (!$this->isCartActive($userId)) {
      $this->insertDataIntoCart($userId);
    }
  }


  public function isCartActive($userId)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT user_id FROM carts WHERE user_id = ? AND checked_out = ?");
    $stmt->execute([$userId, 0]);
    $activeCartId = $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($activeCartId['user_id']);
  }


  function insertDataIntoCart($userId)
  {
    $stmt = $this->database->dbconnection()->prepare("INSERT INTO carts (user_id, quantity, total_price, checked_out) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, 0, 0.00, 0]);
  }


  function getCartId($userId)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT id FROM carts WHERE user_id = ? AND checked_out = ?");
    $stmt->execute([$userId, 0]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    return $cart['id'];
  }


  function getUserCartInfo($userId)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM carts WHERE user_id = ?");
    $stmt->execute([$userId]);
    $userCartInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $userCartInfo;
  }

  //RETURN A SUCCESSFULLY MESSAGE WHEN A CART IS CHECKED
  public function checkoutCart($cartId)
  {
    $stmt = $this->database->dbconnection()->prepare("UPDATE carts SET checked_out = 1 WHERE id = ?");
    $stmt->execute([$cartId]);
    return "Checked out successfully";
  }


  //CLEAR THE USER CART.
  function clearCart($user_id)
  {
    $stmt = $this->database->dbconnection()->prepare("DELETE FROM carts WHERE user_id = ?");
    $stmt->execute([$user_id]);
  }

}