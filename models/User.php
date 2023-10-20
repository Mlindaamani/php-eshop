<?php

class User {
  private $database;

  public function __construct(Database $database)
  {
    $this->database = $database->dbconnection();
  }

  public function isUserPresent(string $email)
  {

    $stmt = $this->database->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results != false;
  }

  public function getUserByFirstName(string $first_name)
  {
    $stmt = $this->database->prepare("SELECT * FROM users WHERE first_name = ?");
    $stmt->execute([$first_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getAllUsers(int $user_id)
  {
    $stmt = $this->database->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function register(string $first_name, string $last_name, string $email, string $password, string $role): void
  {
    $hashed_password = $this->hashEnteredPassword($password);
    $stmt = $this->database->prepare("INSERT INTO users(first_name, last_name, email, password, role) VALUES(?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $hashed_password, 'customer']);
  }

  public function hashEnteredPassword($enteredPassword)
  {
    return password_hash($enteredPassword, PASSWORD_DEFAULT);
  }

  public function authUser(int $user_id)
  {
    $stmt = $this->database->prepare("SELECT first_name FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data['first_name'];
  }
}