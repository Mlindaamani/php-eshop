<?php
class Category {

  private $database;

  public function __construct(Database $database)
  {
    $this->database = $database;
  }

  public function getAllCategories(): array
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM categories");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function deleteCategory($category_id)
  {
    $stmt = $this->database->dbconnection()->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$category_id]);
  }

  public function addCategory($category_name)
  {
    $stmt = $this->database->dbconnection()->prepare("INSERT INTO categories (category_name) VALUES (?)");
    $stmt->execute([$category_name]);
  }

  public function isCategoryPresent($category_name)
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM categories WHERE category_name = ?");
    $stmt->execute([$category_name]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($results['category_name']);
  }
}