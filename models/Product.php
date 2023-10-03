<?php
class Product {
  private $database;


  public function __construct(Database $database)
  {
    $this->database = $database;
  }



  public function getProductInfoById($product_id)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT product_name, price, stock_quantity, description, image_url FROM Products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  function getAllProducts()
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM products ORDER BY RAND()");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function decreaseStockQuantity($productId, $quantity)
  {
    $stmt = $this->database->dbconnection()->prepare("UPDATE products SET stock_quantity = stock_quantity- ? WHERE id = ?");
    $stmt->execute([$quantity, $productId]);
  }

  public function getStockQuantity(int $product_id)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT stock_quantity FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetchColumn();
  }



  function isProductPresent($product_id)
  {
    $product = $this->getProductInfoById($product_id);
    return isset($product['id']);
  }
}