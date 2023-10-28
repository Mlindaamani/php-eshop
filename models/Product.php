<?php
// require 'Database.php';
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
    $this->database = $database->dbconnection();
  }

  /**
   * Summary of getProductInfoById
   * @param mixed $product_id
   * @return array
   */
  public function getProductInfoById($product_id): array
  {
    $stmt = $this->database->prepare("SELECT product_name, price, stock_quantity, description, image_url FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Summary of getAllProducts
   * @return array
   */
  function getAllProducts()
  {
    $stmt = $this->database->prepare("SELECT * FROM products ORDER BY RAND()");
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
    $stmt = $this->database->prepare("UPDATE products SET stock_quantity = stock_quantity- ? WHERE id = ?");
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
    $stmt = $this->database->prepare("UPDATE products SET stock_quantity = stock_quantity + ? WHERE id = ?");
    $stmt->execute([$quantity, $productId]);
  }


  public function create($name, $image_path, $price, $desc, $stock_quantity)
  {
    $stmt = $this->database->prepare("INSERT INTO products(product_name, description, price, stock_quantity, image_url) VALUES(?, ?, ?, ?, ?)");
    $stmt->execute([$name, $desc, $price, $stock_quantity, $image_path]);
  }

  //Returns true if the product exist in the product table.
  public function productExist($image_url)
  {
    $stmt = $this->database->prepare("SELECT * FROM products WHERE image_url = ?");
    $stmt->execute([$image_url]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product != false;


  }


  public function delete($id)
  {
    $stmt = $this->database->prepare("DELETE FROM products  WHERE id = ?");
    $stmt->execute([$id]);

  }


  public function update($product_name, $image_url, $stock_quantity, $description, $price, $id)
  {
    $stmt = $this->database->prepare("UPDATE products SET product_name = ?, image_url = ?, stock_quantity = ?, description, price = ? WHERE id = ?");
    $stmt->execute([$product_name, $image_url, $stock_quantity, $description, $price, $id]);
  }
}