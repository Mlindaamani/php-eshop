<?php

class Database {
  private $databaseConnection;
  private $databaseHost = "localhost";
  private $databaseUser = "root";
  private $databasePassword = "";
  private $databaseName = "ebotdb";



  public function __construct()
  {
    try {
      $this->databaseConnection = new PDO("mysql:host=$this->databaseHost;dbname=$this->databaseName", $this->databaseUser, $this->databasePassword);

      $this->databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      echo "Sorry Unexpected Error has occur: ";
      echo "<br>";
      echo "<br>";
      print_r("Error: " . $e->errorInfo[2]);
      echo "<br>";
      echo "<br>";
      echo "The error is on line: " . $e->getLine();
      echo "<br>";
      echo "<br>";
      echo "File where the error has occured: " . $e->getFile();
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