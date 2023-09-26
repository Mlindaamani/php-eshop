<?php
// include "db.php";
class Product {

  private $db;
  private $price;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function getProductInfoById($product_id)
  {
    $stmt = $this->db->con->prepare("SELECT product_name, price, stock_quantity, description, image_url FROM Products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  function getAllProducts()
  {
    $stmt = $this->db->con->prepare("SELECT * FROM products ORDER BY RAND()");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function decreaseStockQuantity($productId, $quantity)
  {
    $stmt = $this->db->con->prepare("UPDATE products SET stock_quantity = stock_quantity- ? WHERE id = ?");
    $stmt->execute([$quantity, $productId]);
  }

  public function getStockQuantity(int $product_id)
  {
    $stmt = $this->db->con->prepare("SELECT stock_quantity FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetchColumn();
  }



  function isProductPresent($product_id)
  {
    $product = $this->getProductInfoById($product_id);
    return isset($product['id']);
  }
}

// $product = new Product(new Database);

// print_r($product->getProductInfoById(22));

// var_dump($product->isProductPresent(16));
// echo $product->getStockQuantity(19);

// print_r($product->getAllProducts());