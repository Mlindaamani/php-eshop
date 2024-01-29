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


  private const TABLE_NAME = "cart_items";
  private const CART_ITEMS_FETCH_MODE = PDO::FETCH_ASSOC;

  private const INITIAL_CARTITEMS_QUANTITY = 1;

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database;
  }

  /**
   * Summary of addToCart
   * @param int $userId
   * @param Product $product
   * @param Cart $cart
   * @param int $productId
   * @return void
   */
  public function addToCart(int $userId, Product $product, Cart $cart, int $productId)
  {
    $this->database->beginTransaction();

    $cart->createCart($userId);

    $productInfo = $product->getProductInfoById($productId);

    $this->insertCartItem($userId, $productInfo, $cart->getCartId($userId));

    $this->database->commit();
  }


  private function insertCartItem(int $userId, array $productInfo, int $cartId)
  {
    $stmt = $this->database->prepare(
      "INSERT INTO " . self::TABLE_NAME . " 
      (product_name, quantity, product_image, price, total_price, user_id, product_id, cart_id)
      VALUES (:product_name, :quantity, :product_image, :price, :total_price, :user_id, :product_id, :cart_id)"
    );

    $params = [
      'product_name' => $productInfo['product_name'],
      'quantity' => self::INITIAL_CARTITEMS_QUANTITY,
      'product_image' => $productInfo['image_url'],
      'price' => $productInfo['price'],
      'total_price' => $productInfo['price'],
      'user_id' => $userId,
      'product_id' => $productInfo['id'],
      'cart_id' => $cartId,
    ];

    $this->database->execute($params, $stmt);
  }


  /**
   * Summary of updateProductQuantity
   * @param mixed $quantity
   * @param mixed $product_id
   * @param mixed $user_id
   * @return void
   */
  public function updateProductQuantity($quantity, $productId, $userId)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id");
    $stmt->execute([
      'quantity' => $quantity,
      'product_id' => $productId,
      'user_id' => $userId
    ]);
  }

  /**
   * Summary of updateCartItemTotalPrice
   * 
   * @param mixed $total_price
   * @param mixed $product_id
   * @param mixed $user_id
   * @return void
   */
  function updateCartItemTotalPrice(int $productId, int $userId, int $quantity)
  {
    $cartProductPrice = $this->getCartItemPrice($productId, $userId);

    $totalPrice = self::calculateTotalPrice($cartProductPrice, $quantity);

    $this->updateProductQuantity($quantity, $productId, $userId);

    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET  total_price = :total_price WHERE product_id = :product_id AND user_id = :user_id");
    $params = [
      'total_price' => $totalPrice,
      'product_id' => $productId,
      'user_id' => $userId
    ];
    $this->database->execute($params, $stmt);
  }

  /**
   * Summary of subTotal
   * @param int $userId
   * @return float
   */
  public function subTotal(int $userId): float
  {
    $stmt = $this->database->prepare("SELECT SUM(total_price) FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchColumn();
  }

  /**
   * Summary of getItemsCount
   * @param int $userId
   * @return mixed
   */
  public function getItemsCount(int $userId)
  {
    $stmt = $this->database->prepare("SELECT COUNT(*) FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchColumn();
  }

  /**
   * Summary of removeCartItem
   * @param mixed $cartItemId
   * @param mixed $productId
   * @return void
   */
  function removeCartItem($cartItemId, $productId, int $quantity, Product $product)
  {
    $stmt = $this->database->prepare("DELETE FROM " . self::TABLE_NAME .
      " WHERE id = :id AND product_id = :product_id");
    $stmt->execute(['id' => $cartItemId, 'product_id' => $productId]);
    $product->increaseStockQuantity($productId, $quantity);
  }

  /**
   * Summary of cartItems
   * @param int $userId
   * @return array
   */
  function cartItems(int $userId)
  {
    $stmt = $this->database->prepare("SELECT * FROM " . self::TABLE_NAME .
      " WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(self::CART_ITEMS_FETCH_MODE);
  }

  /**
   * Summary of isCartItemEmpty
   * @param User $user
   * @param int $userId
   * @return bool
   */
  public function isCartItemEmpty()
  {
    return ($this->getItemsCount(User::id()) === 0);
  }

  /**
   * Summary of deleteCartItem  
   * @param int $userId
   * @return void
   */

  public function deleteCartItem(int $userId)
  {
    $stmt = $this->database->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
  }

  public function isCartItemPresent(int $productId, $userId)
  {
    $stmt = $this->database->prepare("SELECT product_id, user_id FROM " . self::TABLE_NAME . " WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    return $stmt->rowCount() == 1 ? true : false;
  }

  /**
   * Summary of calcTotalPrice
   * @param float $price
   * @param int $quantity
   * @return float
   */
  public static function calculateTotalPrice(float $price, int $quantity)
  {
    return round($price * $quantity, 2);
  }

  /**
   * Summary of getCartItemPrice
   * @param int $productId
   * @param int $userId
   * @return mixed
   */
  public function getCartItemPrice(int $productId, int $userId)
  {
    $stmt = $this->database->prepare("SELECT price FROM " . self::TABLE_NAME . " WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    return ($stmt->fetch(PDO::FETCH_COLUMN));
  }

  /**
   * Summary of isStockEnough
   * @param int $productId
   * @param int $quantity
   * @param Product $product
   * @return bool
   */
  public static function isStockEnough(int $productId, int $quantity, Product $product)
  {
    return $product->getStockQuantity($productId) >= $quantity;
  }

  public function increaseQuantity(int $productId, int $user_id)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME . " SET quantity = (quantity + 1) WHERE product_id = :product_id AND user_id = :user_id");
    $stmt->execute([
      'product_id' => $productId,
      'user_id' => $user_id,
    ]);
  }
}

