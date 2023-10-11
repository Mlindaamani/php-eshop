<?php
/**
 * Summary of User
 */
class User {

  /**
   * Summary of database
   * @var 
   */
  private $database;

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database;
  }

  /**
   * Summary of getAllUsers
   * @return array
   */
  public function getAllUsers(): array
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  /**
   * Summary of getUserInfoById
   * @param int $user_id
   * @return array
   */
  public function getUserInfoById(int $user_id): array
  {
    $stmt = $this->database->dbconnection()->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  //ALT + <
  /**
   * Summary of isUserPresent
   * @param string $email
   * @return bool
   */
  public function isUserPresent(string $email)
  {

    $stmt = $this->database->dbconnection()->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results != false;
  }

  /**
   * Summary of signup
   * @param string $first_name
   * @param string $last_name
   * @param string $email
   * @param string $password
   * @param string $role
   * @return void
   */
  public function signup(string $first_name, string $last_name, string $email, string $password, string $role): void
  {
    $stmt = $this->database->dbconnection()->prepare("INSERT INTO users(first_name, last_name, email, password, role) VALUES(?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $password, 'customer']);
  }

  // CHECK WHETHER THE SIGNUP FIELDS ARE EMPTY.
  /**
   * Summary of checkForEmptyFields
   * @param mixed $first_name
   * @param mixed $last_name
   * @param mixed $password
   * @param mixed $email
   * @return bool
   */
  public function checkForEmptyFields($first_name, $last_name, $password, $email)
  {
    if (isset($first_name, $last_name, $email, $password)) {
      return true;
    }
    return false;
  }

  //CHECK WHETHER EMAIL AND PASSWORD ARE EMPTY.
  /**
   * Summary of checkForEmptyEmailAndPassword
   * @param mixed $password
   * @param mixed $email
   * @return bool
   */
  public function checkForEmptyEmailAndPassword($password, $email)
  {
    if (isset($email, $password)) {
      return true;
    }
    return false;
  }


  //HASH PASSWORD.
  /**
   * Summary of hashPassword
   * @param mixed $enteredPassword
   * @return string
   */
  public function hashPassword($enteredPassword)
  {
    return password_hash($enteredPassword, PASSWORD_DEFAULT);

  }

  //VERIRY HASHED PASSWORD AGAINST ENTERED PASSWORD.
  /**
   * Summary of verifyHashedPassword
   * @param mixed $enteredPassword
   * @return bool
   */
  public function verifyHashedPassword($enteredPassword)
  {
    if (password_verify($enteredPassword, $this->hashPassword($enteredPassword))) {
      return true;
    }
    return false;
  }
}