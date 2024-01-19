<?php
require_once __DIR__ . "/../config/database.php";


class Database {
  private $databaseConnection;


  public function __construct()
  {
    try {
      $this->databaseConnection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
      $this->databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      echo "Error: {$e->getMessage()}";
    }
  }

  /**
   * Summary of dbconnection
   * @return PDO
   */
  public function dbconnection()
  {
    return $this->databaseConnection;
  }
}


