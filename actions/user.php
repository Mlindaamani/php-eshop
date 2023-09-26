<?php
class User {
  private static $pdo;
  private $first_name;
  private $last_name;
  private $email;
  private $password;
  private $phone_number;


  public static function connect() {
     self::$pdo = new PDO('mysql:host=localhost;dbname=ebotdb', 'root', '');
  }


  public static function disconnect() {
    self::$pdo = null;
  }

  public static function selectUser($userId) {
    self::connect();
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = self::$pdo->prepare($query);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    self::disconnect();
    return $user;
  }

  public static function insertUser($userData) {
    self::connect();
    $query = "INSERT INTO users(name, email) VALUES (:name, :email)";
    $stmt = self::$pdo->prepare($query); 
    $stmt->bindParam(':name', $userData['name']);
    $stmt->bindParam(':email', $userData['email']);
    $stmt->execute();
    self::disconnect();
  }


public static function updateUser($userId, $newName) {
  self::connect();
  $query = "UPDATE users SET first_name = :name WHERE id = :id";
  $stmt = self::$pdo->prepare($query); 
  $stmt->bindParam(':name', $userId);
  $stmt->bindParam(':id', $newName);
  $stmt->execute();
  self::disconnect();
}

public static function deleteUser($userId) {
  self::connect();
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = self::$pdo->prepare($query); 
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    self::disconnect();
}


	/**
	 * @return mixed
	 */
	public function getFirst_name() {
		return $this->first_name;
	}
}
