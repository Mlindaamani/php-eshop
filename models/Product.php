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

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database;
  }

  /**
   * Summary of getProductInfoById
   * @param mixed $product_id
   * @return array
   */
  public function getProductInfoById($product_id): array
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT product_name, price, stock_quantity, description, image_url FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Summary of getAllProducts
   * @return array
   */
  function getAllProducts()
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM products ORDER BY RAND()");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Summary of decreaseStockQuantity
   * @param mixed $productId
   * @param mixed $quantity
   * @return void
   */
  public function decreaseStockQuantity($productId, $quantity)
  {
    $stmt = $this->database->dbconnection()->prepare("UPDATE products SET stock_quantity = stock_quantity- ? WHERE id = ?");
    $stmt->execute([$quantity, $productId]);
  }

  /**
   * Summary of increaseStockQuantity
   * @param mixed $productId
   * @param mixed $quantity
   * @return void
   */
  public function increaseStockQuantity($productId, $quantity)
  {
    $stmt = $this->database->dbconnection()->prepare("UPDATE products SET stock_quantity = stock_quantity + ? WHERE id = ?");
    $stmt->execute([$quantity, $productId]);
  }
}