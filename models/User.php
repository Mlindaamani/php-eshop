<?php

class User {
  private $database;

  private const TABLE_NAME = 'users';
  private const ADMIN_ROLE = 'admin';
  private const DEFAULT_ROLE = 'customer';
  private const ROLE = 'role';
  private const CURRENT_USER = 'user_id';
  private const USER_FETCH_MODE = PDO::FETCH_ASSOC;
  private const DEFAULT_SYSTEM_USER = 'guest';



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
    return ($stmt->rowCount() === 1);
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
      'password' => self::hashPassword($password),
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
    $stmt->execute(['email' => $email]);
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

      if (self::verifyHashedPassword($password, $user['password'])) {
        self::setUserSession($this->getUserByEmail($email)['id']);
        self::setRoleSession($this->getUserByEmail($email)['role']);
        return $user;
      }
    }
    return false;
  }

  /**
   * Summary of hashPassword
   * @param string $password
   * @return string
   */
  public static function hashPassword(string $password)
  {
    return (password_hash($password, PASSWORD_DEFAULT));
  }

  /**
   * Summary of verifyHashedPassword
   * @param mixed $enteredPassword
   * @param mixed $storedPassword
   * @return bool
   */
  public static function verifyHashedPassword($enteredPassword, $storedPassword)
  {
    return password_verify($enteredPassword, $storedPassword);
  }

  /**
   * Summary of setUserSession
   * @param int $userId
   * @return void
   */
  public static function setUserSession(int $userId)
  {
    $_SESSION[self::CURRENT_USER] = $userId;
  }

  /**
   * Summary of setRoleSession
   * @param string $role
   * @return void
   */

  public static function setRoleSession(string $role)
  {
    $_SESSION[self::ROLE] = $role;
  }

  /**
   * Summary of isAdmin
   * @return bool
   */
  public static function isAdmin()
  {
    return self::role() === self::ADMIN_ROLE;
  }

  /**
   * Summary of isLoggedIn
   * @return bool
   */
  public static function isLoggedIn()
  {
    return isset($_SESSION[self::CURRENT_USER]);
  }


  /**
   * Summary of id
   * @return int|null
   */
  public static function id(): int|null
  {
    return isset($_SESSION[self::CURRENT_USER]) ? $_SESSION[self::CURRENT_USER] : null;
  }

  /**
   * Summary of role
   * @return string|null
   */
  public static function role(): string|null
  {
    return isset($_SESSION[self::ROLE]) ? $_SESSION[self::ROLE] : self::DEFAULT_SYSTEM_USER;
  }

  /**
   * Summary of logout
   * @return bool
   */
  public static function logout()
  {
    session_start();
    session_regenerate_id(true);
    session_unset();
    session_destroy();
    return true;
  }
}