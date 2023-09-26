<?php
// include 'db.php';
class Cart {

  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }


  public function createNewCart($userId)
  {
    // If no active cart create new cart.
    if (!$this->isCartActive($userId)) {
      $this->insertCartInfo($userId);
    }
  }


  public function isCartActive($userId)
  {
    $stmt = $this->db->con->prepare("SELECT user_id FROM carts WHERE user_id = ? AND checked_out = 0");
    $stmt->execute([$userId]);
    $activeCartId = $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($activeCartId['user_id']);
  }


  function insertCartInfo($userId)
  {
    $stmt = $this->db->con->prepare("INSERT INTO carts (user_id, checked_out) VALUES (?, 0)");
    $stmt->execute([$userId]);
  }

  function getCartId($userId)
  {
    $stmt = $this->db->con->prepare("SELECT id FROM carts WHERE user_id = ? AND checked_out = 0");
    $stmt->execute([$userId]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    return $cart['id'];
  }




  function getUserCartInfo($userId)
  {
    $stmt = $this->db->con->prepare("SELECT * FROM carts WHERE user_id = ?");
    $stmt->execute([$userId]);
    $userCartInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $userCartInfo;
  }


  public function checkoutCart($cartId)
  {
    $stmt = $this->db->con->prepare("UPDATE carts SET checked_out = 1 WHERE id = ?");
    $stmt->execute([$cartId]);
  }

}
// $cart = new Cart(new Database);