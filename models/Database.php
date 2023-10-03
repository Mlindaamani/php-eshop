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

      die("Connection failed: " . $e->getMessage());
    }
  }

  public function dbconnection()
  {
    return $this->databaseConnection;
  }

}