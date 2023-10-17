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

      echo "<h1>SORRY THE SERVER IS CURRENTLY DOWN WE WILL FIX IT WITHIN NO TIME!</h1>";
      exit;
    }
  }

  public function dbconnection()
  {
    return $this->databaseConnection;
  }


  /**
   * @return mixed
   */
  public function getDatabaseConnection()
  {
    return $this->databaseConnection;
  }

  /**
   * @param mixed $databaseConnection 
   * @return self
   */
  public function setDatabaseConnection($databaseConnection): self
  {
    $this->databaseConnection = $databaseConnection;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDatabaseHost()
  {
    return $this->databaseHost;
  }

  /**
   * @param mixed $databaseHost 
   * @return self
   */
  public function setDatabaseHost($databaseHost): self
  {
    $this->databaseHost = $databaseHost;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDatabaseUser()
  {
    return $this->databaseUser;
  }

  /**
   * @param mixed $databaseUser 
   * @return self
   */
  public function setDatabaseUser($databaseUser): self
  {
    $this->databaseUser = $databaseUser;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDatabasePassword()
  {
    return $this->databasePassword;
  }

  /**
   * @param mixed $databasePassword 
   * @return self
   */
  public function setDatabasePassword($databasePassword): self
  {
    $this->databasePassword = $databasePassword;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDatabaseName()
  {
    return $this->databaseName;
  }

  /**
   * @param mixed $databaseName 
   * @return self
   */
  public function setDatabaseName($databaseName): self
  {
    $this->databaseName = $databaseName;
    return $this;
  }
}