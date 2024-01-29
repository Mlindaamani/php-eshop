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
   * Returns the database connection.
   * 
   * @return PDO
   */
  public function dbConnection()
  {
    return $this->databaseConnection;
  }

  /**
   * Begins a transaction.
   */
  public function beginTransaction()
  {
    $this->dbConnection()->beginTransaction();
  }

  /**
   * Commits the current transaction.
   */
  public function commit()
  {
    $this->dbConnection()->commit();
  }

  /**
   * Prepares an SQL statement for execution.
   * 
   * @param string $sql
   * @return PDOStatement
   */
  public function prepare($sql)
  {
    return $this->dbConnection()->prepare($sql);
  }

  public function execute(array $params, PDOStatement $pDOStatement)
  {
    return $pDOStatement->execute($params);
  }
}

