<?php

class User {
  private $database;

  private const TABLE_NAME = 'users';
  private const ADMIN_ROLE = 'admin';
  private const DEFAULT_ROLE = 'customer';
  private const ROLE_SESSION = 'role';
  private const USER_SESSION = 'user_id';

  private const USER_FETCH_MODE = PDO::FETCH_ASSOC;

  /**
   * Summary of __construct
   * @param Database $database
   */
  public function __construct(Database $database)
  {
    $this->database = $database->dbconnection();
  }

  /**
   * Summary of isUserPresent
   * @param string $email
   * @return bool
   */
  public function isUserPresent(string $email)
  {
    $stmt = $this->database->prepare("SELECT email FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return ($stmt->rowCount() === 1) ? true : false;
  }

  public function getUserByFirstName(string $first_name)
  {
    $stmt = $this->database->prepare("SELECT * FROM users WHERE first_name = :first_name");
    $stmt->execute(['first_name' => $first_name]);
    return $stmt->fetch(self::USER_FETCH_MODE);
  }

  /**
   * Summary of register
   * @param string $first_name
   * @param string $last_name
   * @param string $email
   * @param string $password
   * @param string $role
   * @return void
   */
  public function register(
    string $first_name,
    string $last_name,
    string $email,
    string $password,
    string $role
  ) {
    $stmt = $this->database->prepare("INSERT INTO users(first_name, last_name, email, password, role) 
    VALUES(:first_name, :last_name, :email, :password, :role)
    ");

    $stmt->execute([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'role' => self::DEFAULT_ROLE
    ]);
  }

  /**
   * Summary of authUser
   * @param int $userId
   * @return mixed
   */
  public function authUser(int $userId)
  {
    $stmt = $this->database->prepare("SELECT first_name FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetch(self::USER_FETCH_MODE)['first_name'] ?? false;
  }

  /**
   * Summary of getUserInfo
   * @param mixed $email
   * @param mixed $password
   * @return array|bool
   */
  public function getUserByEmail(string $email): array|bool
  {
    $stmt = $this->database->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([
      'email' => $email
    ]);
    return ($stmt->rowCount() == 1) ? $stmt->fetch(self::USER_FETCH_MODE) : false;
  }

  /**
   * Summary of login
   * @param string $email
   * @param string $password
   * @return array|bool
   */
  public function login(string $email, string $password)
  {
    $user = $this->getUserByEmail($email);

    if ($user) {

      if ($this->verifyHashedPassword($password, $user['password'])) {
        $this->setUserSession($user['id']);
        $this->setRoleSession($user['role']);
        return $user;
      }
    }
    return false;
  }

  /**
   * Summary of verifyHashedPassword
   * @param mixed $enteredPassword
   * @param mixed $storedPassword
   * @return bool
   */
  public function verifyHashedPassword($enteredPassword, $storedPassword)
  {
    return password_verify($enteredPassword, $storedPassword);
  }

  /**
   * Summary of setUserSession
   * @param int $userId
   * @return void
   */
  public function setUserSession(int $userId)
  {
    $_SESSION[self::USER_SESSION] = $userId;
  }

  /**
   * Summary of setRoleSession
   * @param string $role
   * @return void
   */
  public function setRoleSession(string $role)
  {
    $_SESSION[self::ROLE_SESSION] = $role;
  }

  /**
   * Summary of getUserRole
   * @param int $userId
   * @return bool
   */
  public function isAdmin(int $userId)
  {
    $stmt = $this->database->prepare("SELECT role FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    $user = $stmt->fetch(self::USER_FETCH_MODE);
    return ($user[self::ROLE_SESSION] === self::ADMIN_ROLE) ? true : false;
  }
}