<?php
class Database {
  public $con;
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "ebotdb";


  public function __construct()
  {
    try {
      $this->con = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
      $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }
}