<?php

/**
 * Summary of Category
 */
class Category {

  /**
   * Summary of database
   * @var 
   */
  private $database;

  private const TABLE_NAME = "categories";

  private const CATEGORY_FETCH_MODE = PDO::FETCH_ASSOC;

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database->dbconnection();
  }

  /**
   * Summary of getAllCategories
   * @return void
   */
  public function getAllCategories(): array
  {
    $stmt = $this->database->prepare("SELECT * FROM " . self::TABLE_NAME);
    $stmt->execute();
    return $stmt->fetchAll(self::CATEGORY_FETCH_MODE);
  }

  /**
   * Summary of deleteCategory
   * @param mixed $category_id
   * @return void
   */
  public function deleteCategory($categoryId)
  {
    $stmt = $this->database->prepare("DELETE FROM " . self::TABLE_NAME .
      " WHERE id = :id");
    $stmt->execute(["id" => $categoryId]);
  }

  /*
   * Summary of addCategory
   * @param mixed $category_name
   * @return void
   */
  public function addCategory($categoryName)
  {
    $stmt = $this->database->prepare("INSERT INTO " . self::TABLE_NAME .
      " (category_name) VALUES (:category_name)");
    $stmt->execute(["category_name" => $categoryName]);
  }


  /**
   * Summary of isCategoryPresent
   * @param mixed $categoryName
   * @return bool
   */
  public function isCategoryPresent($categoryName)
  {
    $stmt = $this->database->prepare("SELECT category_name FROM " . self::TABLE_NAME .
      " WHERE category_name = :category_name");

    $stmt->execute(["category_name" => $categoryName]);

    return ($stmt->rowCount() > 0) ? true : false;
  }
}