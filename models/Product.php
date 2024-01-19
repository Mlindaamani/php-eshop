<?php

/**
 * Summary of Product
 */
class Product {
  /**
   * Summary of database
   * @var 
   */
  private $database;

  private const TABLE_NAME = 'products';

  private const PRODUCTS_FETCH_MODE = PDO::FETCH_ASSOC;

  private const CURRENT_USER_STATUS = 1000;

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database->dbconnection();
  }


  /**
   * Summary of getProductInfoById
   * @param int $productId
   * @return array
   */
  public function getProductInfoById(int $productId): array
  {
    $stmt = $this->database->prepare("SELECT product_name, price, stock_quantity, description, image_url FROM " . self::TABLE_NAME .
      " WHERE id = :id");
    $stmt->execute(["id" => $productId]);

    return $stmt->fetch(self::PRODUCTS_FETCH_MODE);
  }

  /**
   * Summary of products 
   * @return array
   */
  function products()
  {
    $stmt = $this->database->prepare("SELECT * FROM " . self::TABLE_NAME .
      " ORDER BY RAND()");
    $stmt->execute();
    return $stmt->fetchAll(self::PRODUCTS_FETCH_MODE);
  }

  /**
   * Summary of decreaseStockQuantity
   * @param mixed $productId
   * @param mixed $quantity
   * @return void
   */
  public function decreaseStockQuantity($productId, $quantity)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET stock_quantity = stock_quantity- :stock_quantity WHERE id = :id");
    $stmt->execute(['stock_quantity' => $quantity, 'id' => $productId]);
  }

  /**
   * Summary of increaseStockQuantity
   * @param mixed $productId
   * @param mixed $quantity
   * @return void
   */
  public function increaseStockQuantity($productId, $quantity)
  {
    $stmt = $this->database->prepare("UPDATE " . self::TABLE_NAME .
      " SET stock_quantity = stock_quantity + :quantity WHERE id = :id");
    $stmt->execute(['quantity' => $quantity, 'id' => $productId]);
  }

  /**
   * Summary of create
   * @param string $name
   * @param string $imageUrl
   * @param float $price
   * @param string $desc
   * @param int $stockQuantity
   * @return void
   */
  public function create(string $name, string $imageUrl, float $price, string $desc, int $stockQuantity)
  {
    $stmt = $this->database->prepare("INSERT INTO " . self::TABLE_NAME .
      "(product_name, description, price, stock_quantity, image_url) 
      VALUES(:product_name, :description, :price, :stock_quantity, :image_url)");

    $stmt->execute([
      'product_name' => $name,
      'description' => $desc,
      'price' => $price,
      'stock_quantity' => $stockQuantity,
      'image_url' => $imageUrl
    ]);
  }


  /**
   * Summary of isPresent
   * @param string $imageUrl
   * @return bool
   */
  public function isPresent(string $imageUrl)
  {
    $stmt = $this->database->prepare("SELECT * FROM " . self::TABLE_NAME .
      " WHERE image_url = :image_url");
    $stmt->execute(['image_url' => $imageUrl]);
    return ($stmt->rowCount() == 1) ? true : false;
  }

  /**
   * Summary of update
   * @param mixed $productName
   * @param mixed $imageUrl
   * @param mixed $stockQuantity
   * @param mixed $description
   * @param mixed $price
   * @param mixed $productId
   * @return void
   */


  /**
   * Summary of getStockQuantity
   * @param int $id
   * @return mixed
   */
  public function getStockQuantity(int $id)
  {
    $stmt = $this->database->prepare("SELECT stock_quantity FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return ($stmt->rowCount() == 1) ? $stmt->fetch(PDO::FETCH_COLUMN) : null;
  }


  
}