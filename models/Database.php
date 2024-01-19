<?php

/**
 * Summary of Database
 */
class Database {

  /**
   * 
   * Summary of databaseConnection
   * @var 
   */
  private $databaseConnection;
  /**
   * Summary of databaseHost
   * @var string
   */
  private $databaseHost = 'localhost';
  /**
   * Summary of databaseUser
   * @var string
   */
  private $databaseUser = 'root';
  /**
   * Summary of databasePassword
   * @var string
   */
  private $databasePassword = "";
  /**
   * Summary of databaseName
   * @var string
   */
  private $databaseName = 'ebotdb';



  /**
   * Summary of __construct
   */
  public function __construct()
  {
    try {
      $this->databaseConnection = new PDO("mysql:host=$this->databaseHost;dbname=$this->databaseName", $this->databaseUser, $this->databasePassword);
      $this->databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      echo "Erroe: {$e->getMessage()}";
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

// print_r(dbconnection());